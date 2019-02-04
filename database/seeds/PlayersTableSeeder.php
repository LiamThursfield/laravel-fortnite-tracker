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
        DB::table('players')->insert([
            'username' => 'Liam_Thursfield',
            'is_epic_account' => true
        ]);

        $player = \App\Models\Player::whereUsername('Liam_Thursfield')->first();
        $platforms = \App\Models\Platform::all();

        if ($player && count($platforms)) {
            foreach ($platforms as $platform) {
                DB::table('player_platforms')->insert([
                    'player_id' => $player->id,
                    'platform_id' => $platform->id
                ]);
            }
        }

    }
}
