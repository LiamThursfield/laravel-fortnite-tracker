<?php

namespace App\Console\Commands;

use App\ApiWrappers\TrackerNetwork\FortniteTracker\FortniteTrackerService;
use App\Helpers\PlayerLifetimeStatsHelper;
use App\Helpers\PlayerPlaylistStatsHelper;
use App\Models\Platform;
use App\Models\Player;
use App\Models\PlayerPlatform;
use App\Models\PlayerPlaylistStats;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PlayerGetStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'player:getstats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch the stats of player\'s whose stats have not been fetched recently';

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
        $this->info('Starting: Player - Get Stats');
        $current_date = Carbon::now();

        // Get a player platform that have not been fetched in the last 5 minutes
        /** @var PlayerPlatform $player_platform */
        $player_platform = PlayerPlatform::requiresFetching(5)->first();
        if (!$player_platform) {
            $this->info('There are no player stats that need fetching');
            return true;
        }
        $player_platform->fetched_at = $current_date;
        $player_platform->save();

        // Ensure the player and the platform are valid
        /** @var Player $player */
        $player = $player_platform->player;
        /** @var Platform $platform */
        $platform = $player_platform->platform;
        if (!$player || !$platform) {
            $this->error("PlayerPlatform {$player_platform->id} has an invalid player/platform.");
            return false;
        }

        // Get the epic nickname for the player
        if (!$player->is_epic_account) {
            $epic_nickname = "{$platform->fn_api_username_wrapper}({$player->username})";
        } else {
            $epic_nickname = $player->username ;
        }

        $this->info("Fetching {$platform->platform_friendly} stats for {$player->username}");
        $api = new FortniteTrackerService(config('tracker_network.api_key'));
        $profile = $api->getPlayerProfile($platform->fn_api_code, $epic_nickname);
        unset($epic_nickname);

        // Ensure the api call was successful
        if (!$profile) {
            $this->error("Failed to fetch the player stats.");
            return false;
        }

        // Create/Update the playlist stats
        $this->info('Updating the Player Playlist Stats');
        if (!PlayerPlaylistStatsHelper::updateViaApiPlayerStats(
            $player->id, $platform->id, $profile->getPlayerStats()
        )) {
            $this->error('Failed to update the Player Playlist Stats');
            return false;
        }

        // Creat/Update the lifetime stats
        $this->info('Updating the Player Lifetime Stats');
        if (!PlayerLifetimeStatsHelper::updateViaApiLifetimeStats(
            $player->id, $platform->id, $profile->getLifetimeStats()
        )) {
            $this->error('Failed to update the Player Lifetime Stats');
            return false;
        }

        $this->info('Completed');
        return true;
    }
}
