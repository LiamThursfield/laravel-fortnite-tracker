<?php

namespace App\Console\Commands;

use App\Models\Player;
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
        dd('hey');

    }
}
