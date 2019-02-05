<?php

namespace App\Console\Commands;

use App\Models\Player;
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

        // Get the oldest player to be last fetched, that does not have an account id
        $player = Player::whereNull('account_id')->orderBy('');
    }
}
