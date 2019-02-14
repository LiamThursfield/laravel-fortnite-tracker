<?php

use Illuminate\Database\Seeder;

class PlatformsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();

        DB::table('platforms')->insert([
            'id' => 'playstation',
            'platform_friendly' => 'Playstation',
            'fn_api_code' => 'psn',
            'fn_api_username_wrapper' => 'psn',
            'created_at' => $now
        ]);

        DB::table('platforms')->insert([
            'id' => 'xbox',
            'platform_friendly' => 'Xbox',
            'fn_api_code' => 'xbl',
            'fn_api_username_wrapper' => 'xbl',
            'created_at' => $now
        ]);

        DB::table('platforms')->insert([
            'id' => 'pc',
            'platform_friendly' => 'PC',
            'fn_api_code' => 'pc',
            'created_at' => $now
        ]);
    }
}
