<?php

namespace App\Helpers;

use App\ApiWrappers\TrackerNetwork\FortniteTracker\Models\PlayerStats;
use App\ApiWrappers\TrackerNetwork\FortniteTracker\Models\Playlist;
use App\Models\Player;
use App\Models\PlayerLifetimeStats;
use App\Models\PlayerPlaylistStats;
use Carbon\Carbon;

class PlayerPlaylistStatsHelper {

    /**
     * Create/Update the Player Playlist stats
     * using the PlayerStats fetched via the API
     * @param Player|null $player
     * @param string|null $platform_id
     * @param PlayerStats|null $player_stats
     *
     * @return bool
     */
    public static function updateViaApiPlayerStats(Player $player = null, string $platform_id = null, PlayerStats $player_stats = null) {
        if (is_null($player) || is_null($platform_id) || is_null($player_stats)) {
            return false;
        }

        $current_date = Carbon::now();
        $current_season = SeasonHelper::getCurrentSeasonName();

        foreach ($player_stats->getPlaylistStats() as $playlist_stats) {

            if (!is_null($playlist_stats)) {
                $playlist = $playlist_stats->getPlaylist();

                if ($playlist->getPlaylistPeriod() === Playlist::PLAYLIST_PERIOD_CURRENT) {
                    $period = $current_season;
                } else {
                    $period = $playlist->getPlaylistPeriod();
                }

                $player_playlist_stats = PlayerPlaylistStats::firstOrNew(
                    [
                        'player_id' => $player->id, 'player_username' => $player->username, 'platform_id' => $platform_id,
                        'playlist' => $playlist->getPlaylistName(), 'period' => $period
                    ],
                    [
                        'created_at' => $current_date
                    ]
                );

                $player_playlist_stats->matches_played = $playlist_stats->getMatches();
                $player_playlist_stats->kills = $playlist_stats->getKills();
                $player_playlist_stats->kd = $playlist_stats->getKd();
                $player_playlist_stats->kpm = $playlist_stats->getKillsPerMatch();
                $player_playlist_stats->score = $playlist_stats->getScore();
                $player_playlist_stats->spm = $playlist_stats->getScorePerMatch();
                $player_playlist_stats->top_1 = $playlist_stats->getTop1();
                $player_playlist_stats->top_1_ratio = $playlist_stats->getTop1() / $playlist_stats->getMatches();
                $player_playlist_stats->top_5 = $playlist_stats->getTop1() + $playlist_stats->getTop3() + $playlist_stats->getTop5();
                $player_playlist_stats->updated_at = $current_date;

                $player_playlist_stats->save();
                unset($player_playlist_stats);
            }
        }

        return true;
    }

    /**
     * Get all active seasons
     * -- i.e. seasons that current players have played in
     * @param string $order_direction
     * @return String[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getActiveSeasons($order_direction = 'ASC') {
        return PlayerPlaylistStats::select('period')
            ->groupBy('period')
            ->orderBy('period', $order_direction)
            ->get()->pluck('period');
    }

    public static function getCumulativeStats($platform = 'combined', $season = 'lifetime', $playlist = 'all') {

        $stats = PlayerPlaylistStats::wherePeriod($season);

        if ($platform !== 'combined') {
            $stats->wherePlatformId($platform);
        }
        if ($playlist !== 'all') {
            $stats->wherePlaylist($playlist);
        }

        $stats = $stats->groupBy('player_id')
            ->selectRaw('player_id, sum(matches_played) as matched_played, sum(kills) as kills, sum(score) as score, sum(top_1) as top_1, sum(top_5) as $top_5, sum(matches_played - top_1) as deaths')
            ->get();

        $player_stats = [];

        foreach ($stats as $player_stat) {
           $player = $player_stat->player;
           $player_stats[$player->username]['stats'] = $player_stat;
           $player_stats[$player->username]['stats']['kd'] =
               number_format(($player_stat->kills / $player_stat->deaths), 2);
        }

        return $player_stats;
    }

}
