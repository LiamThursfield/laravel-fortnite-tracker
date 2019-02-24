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

        // Liam_Thursfield
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

        // CoopsWasTaken
        DB::table('players')->insert([
            'username' => 'CoopsWasTaken',
            'is_epic_account' => false
        ]);
        $player = \App\Models\Player::whereUsername('CoopsWasTaken')->first();
        $platform = \App\Models\Platform::find('playstation');
        DB::table('player_platforms')->insert([
            'player_id' => $player->id,
            'platform_id' => $platform->id,
            'created_at' => $now
        ]);

        // oEZZAo
        DB::table('players')->insert([
            'username' => 'oEZZAo',
            'is_epic_account' => true
        ]);
        $player = \App\Models\Player::whereUsername('oEZZAo')->first();
        $platform = \App\Models\Platform::find('playstation');
        DB::table('player_platforms')->insert([
            'player_id' => $player->id,
            'platform_id' => $platform->id,
            'created_at' => $now
        ]);
        $platform = \App\Models\Platform::find('xbox');
        DB::table('player_platforms')->insert([
            'player_id' => $player->id,
            'platform_id' => $platform->id,
            'created_at' => $now
        ]);

        // CeeJaySteele
        DB::table('players')->insert([
            'username' => 'CeeJaySteele',
            'is_epic_account' => true
        ]);
        $player = \App\Models\Player::whereUsername('CeeJaySteele')->first();
        $platform = \App\Models\Platform::find('playstation');
        DB::table('player_platforms')->insert([
            'player_id' => $player->id,
            'platform_id' => $platform->id,
            'created_at' => $now
        ]);

        // Murfin94
        DB::table('players')->insert([
            'username' => 'Murfin94',
            'is_epic_account' => true
        ]);
        $player = \App\Models\Player::whereUsername('Murfin94')->first();
        $platform = \App\Models\Platform::find('playstation');
        DB::table('player_platforms')->insert([
            'player_id' => $player->id,
            'platform_id' => $platform->id,
            'created_at' => $now
        ]);

    }
}
