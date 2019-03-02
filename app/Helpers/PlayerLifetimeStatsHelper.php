<?php

namespace App\Helpers;

use App\ApiWrappers\TrackerNetwork\FortniteTracker\Models\LifetimeStats;
use App\Models\Player;
use App\Models\PlayerLifetimeStats;
use Carbon\Carbon;

class PlayerLifetimeStatsHelper {

    /**
     * Create/Update the Player Lifetime stats for all players
     * using the LifetimeStats fetched via the API
     * @param Player|null $player
     * @param string|null $platform_id
     * @param LifetimeStats|null $lifetime_stats
     *
     * @return bool
     */
    public static function updateViaApiLifetimeStats(Player $player = null, string $platform_id = null, LifetimeStats $lifetime_stats = null) {
        if (is_null($player) || is_null($platform_id) || is_null($lifetime_stats)) {
            return false;
        }

        $current_date = Carbon::now();

        $player_lifetime_stats = PlayerLifetimeStats::firstOrNew(
            ['player_id' => $player->id, 'player_username' => $player->username, 'platform_id' => $platform_id],
            ['created_at' => $current_date]
        );

        $player_lifetime_stats->matches_played = $lifetime_stats->getMatches();
        $player_lifetime_stats->kills = $lifetime_stats->getKills();
        $player_lifetime_stats->kd = $lifetime_stats->getKd();
        $player_lifetime_stats->kpm = $lifetime_stats->getKillsPerMatch();
        $player_lifetime_stats->score = $lifetime_stats->getScore();
        $player_lifetime_stats->spm = $lifetime_stats->getScorePerMatch();
        $player_lifetime_stats->top_1 = $lifetime_stats->getTop1();
        $player_lifetime_stats->top_1_ratio = $lifetime_stats->getTop1() / $lifetime_stats->getMatches();
        $player_lifetime_stats->top_5 = $lifetime_stats->getTop1() + $lifetime_stats->getTop3() + $lifetime_stats->getTop5();
        $player_lifetime_stats->updated_at = $current_date;

        $player_lifetime_stats->save();

        return true;
    }

    /**
     * Get the cumulative lifetime stats
     * @param int $per_page
     * @param int $page
     * @return array
     */
    public static function getAllPlayersCumulative($per_page = 10, $page = 1) {
        $players = Player::whereNotNull('account_id')
            ->with('lifetime_stats')
            ->orderBy('username', 'asc')
            ->paginate($per_page, ['*'], 'page', $page);

        $player_stats = [];
        foreach ($players as $player) {
            $matches = 0;
            $wins = 0;
            $kills = 0;
            $deaths = 0;

            foreach ($player->lifetime_stats as $lifetime_stats) {
                $matches += $lifetime_stats->matches_played;
                $kills += $lifetime_stats->kills;
                $wins += $lifetime_stats->top_1;
                $deaths += ($lifetime_stats->kills / $lifetime_stats->kd);
            }
            unset($lifetime_stats);

            $kd = number_format($kills / $deaths, 2);
            $deaths = round($deaths);

            $player_stats[$player->username] = [
                'matches_played' => $matches,
                'top_1' => $wins,
                'kills' => $kills,
                'deaths' => $deaths,
                'kd' => $kd,
            ];
        }

        return $player_stats;
    }

}
