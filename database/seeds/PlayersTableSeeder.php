<?php

use Illuminate\Database\Seeder;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();

        // User with no platforms
        DB::table('players')->insert([
            'username' => 'JohnSmith',
            'is_epic_account' => true,
            'created_at' => $now
        ]);

        // User with all platforms
        DB::table('players')->insert([
            'username' => 'Liam_Thursfield',
            'is_epic_account' => true,
            'created_at' => $now
        ]);

        $player = \App\Models\Player::whereUsername('Liam_Thursfield')->first();
        $platforms = \App\Models\Platform::all();

        if ($player && count($platforms)) {
            foreach ($platforms as $platform) {
                DB::table('player_platforms')->insert([
                    'player_id' => $player->id,
                    'platform_id' => $platform->id,
                    'created_at' => $now
                ]);
            }
        }

        // User with a platform but no epic account
        DB::table('players')->insert([
            'username' => 'coopswastaken',
            'is_epic_account' => false
        ]);

        $player = \App\Models\Player::whereUsername('coopswastaken')->first();
        $platform = \App\Models\Platform::find('playstation');
        DB::table('player_platforms')->insert([
            'player_id' => $player->id,
            'platform_id' => $platform->id,
            'created_at' => $now
        ]);

    }
}
