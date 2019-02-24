<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SeasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *php
     * @return void
     */
    public function run()
    {
        $current_date = Carbon::now();

        DB::table('seasons')->insert([
            'season_name' => 'Season 1',
            'start_date' => new Carbon('25-Oct-2017'),
            'created_at' => $current_date,
            'updated_at' => $current_date,
        ]);

        DB::table('seasons')->insert([
            'season_name' => 'Season 2',
            'start_date' => new Carbon('14-Dec-2017'),
            'created_at' => $current_date,
            'updated_at' => $current_date,
        ]);

        DB::table('seasons')->insert([
            'season_name' => 'Season 3',
            'start_date' => new Carbon('22-Feb-2018'),
            'created_at' => $current_date,
            'updated_at' => $current_date,
        ]);

        DB::table('seasons')->insert([
            'season_name' => 'Season 4',
            'start_date' => new Carbon('1-May-2018'),
            'created_at' => $current_date,
            'updated_at' => $current_date,
        ]);

        DB::table('seasons')->insert([
            'season_name' => 'Season 5',
            'start_date' => new Carbon('12-Jul-2018'),
            'created_at' => $current_date,
            'updated_at' => $current_date,
        ]);

        DB::table('seasons')->insert([
            'season_name' => 'Season 6',
            'start_date' => new Carbon('27-Sep-2018'),
            'created_at' => $current_date,
            'updated_at' => $current_date,
        ]);

        DB::table('seasons')->insert([
            'season_name' => 'Season 7',
            'start_date' => new Carbon('6-Dec-2018'),
            'created_at' => $current_date,
            'updated_at' => $current_date,
        ]);

        DB::table('seasons')->insert([
            'season_name' => 'Season 8',
            'start_date' => new Carbon('1-Mar-2018'),
            'created_at' => $current_date,
            'updated_at' => $current_date,
        ]);
    }
}
