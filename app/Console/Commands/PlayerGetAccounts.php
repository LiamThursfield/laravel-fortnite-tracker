<?php

namespace App\Console\Commands;

use App\ApiWrappers\TrackerNetwork\FortniteTracker\FortniteTrackerService;
use App\Models\Platform;
use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PlayerGetAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'player:getaccounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch the accounts of player\'s whose account ids have not been set.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Starting: Player - Get Accounts');

        // Get any players with no account id, that have not had a fetch attempt in the last 12 hours
        $player = Player::whereNull('account_id')
            ->where(function ($player) {
                $player->where('fetched_at', '<', Carbon::now()->subHours(12))
                    ->orWhereNull('fetched_at');
            })
            ->whereHas('platforms')
            ->orderBy('fetched_at', 'asc')
            ->first();

        if (!$player) {
            $this->info('There are no players whose accounts need fetching');
            return true;
        }

        // If a player does not have an epic account
        // then they need a non-pc account to allow api usage
        if (!$player->is_epic_account) {
            /** @var Platform $platform */
            $platform = $player->platforms()->where('platforms.id', '<>', 'pc')->first();
        } else {
            /** @var Platform $platform */
            $platform = $player->platforms()->first();
        }

        if (!$platform) {
            $error_message = "Player {$player->username} ";
            if (!$player->is_epic_account) {
                $error_message .= 'does not have an epic account but has no valid (non-pc) platforms.';
            } else {
                $error_message .= 'has no platforms.';
            }
            $this->error($error_message);
            $player->fetched_at = Carbon::now();
            $player->save();
            return false;
        }

        $api = new FortniteTrackerService(config('tracker_network.api_key'));
        if (!$player->is_epic_account) {
            $epic_nickname = "{$platform->fn_api_username_wrapper}({$player->username})";
        } else {
            $epic_nickname = $player->username ;
        }

        $profile = $api->getPlayerProfile($platform->fn_api_code, $epic_nickname);
        if (!$profile) {
            $this->error("Player with nickname {$epic_nickname} does not exist");
        } else {
            $this->info("Account ID for {$epic_nickname} is: {$profile->getAccountId()} ");
            $player->account_id = $profile->getAccountId();
        }
        $player->fetched_at = Carbon::now();
        $player->updated_at = Carbon::now();
        $player->save();

        return !!$profile;
    }
}
