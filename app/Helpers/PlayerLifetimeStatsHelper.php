<?php

namespace App\Helpers;

use App\ApiWrappers\TrackerNetwork\FortniteTracker\Models\LifetimeStats;
use App\Models\PlayerLifetimeStats;
use Carbon\Carbon;

class PlayerLifetimeStatsHelper {

    /**
     * Create/Update the Player Lifetime stats
     * using the LifetimeStats fetched via the API
     * @param int|null $player_id
     * @param string|null $platform_id
     * @param LifetimeStats|null $lifetime_stats
     *
     * @return bool
     */
    public static function updateViaApiLifetimeStats(int $player_id = null, string $platform_id = null, LifetimeStats $lifetime_stats = null) {
        if (is_null($player_id) || is_null($platform_id) || is_null($lifetime_stats)) {
            return false;
        }

        $current_date = Carbon::now();

        $player_lifetime_stats = PlayerLifetimeStats::firstOrNew(
            ['player_id' => $player_id, 'platform_id' => $platform_id],
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

}
