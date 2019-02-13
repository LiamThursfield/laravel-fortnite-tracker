<?php

namespace App\ApiWrappers\TrackerNetwork\FortniteTracker\Models;

class LifetimeStats extends Stats {

    // Define the constants for the stats codes
    public const STATS_CODE_MATCHES = 'Matches Played';
    public const STATS_CODE_SCORE = 'Score';
    public const STATS_CODE_KILLS = 'Kills';
    public const STATS_CODE_KD = 'K/d';
    public const STATS_CODE_TOP_1 = 'Wins';
    public const STATS_CODE_TOP_3 = 'Top 3s';
    public const STATS_CODE_TOP_5 = 'Top 5s';
    public const STATS_CODE_TOP_6 = 'Top 6s';
    public const STATS_CODE_TOP_10 = 'Top 10';
    public const STATS_CODE_TOP_12 = 'Top 12s';
    public const STATS_CODE_TOP_25 = 'Top 25s';

    /**
     * LifetimeStats constructor.
     * @param array $lifetime_stats
     */
    public function __construct(array $lifetime_stats) {
        $lifetime_stats = $this->parseStatsArray($lifetime_stats);

        $this->matches          = $this->parseInteger(array_get($lifetime_stats, self::STATS_CODE_MATCHES, 0));
        $this->score            = $this->parseInteger(array_get($lifetime_stats, self::STATS_CODE_SCORE, 0));
        $this->kills            = $this->parseInteger(array_get($lifetime_stats, self::STATS_CODE_KILLS, 0));
        $this->kd               = $this->parseFloat(array_get($lifetime_stats, self::STATS_CODE_KD, 0));
        $this->top_1            = $this->parseInteger(array_get($lifetime_stats, self::STATS_CODE_TOP_1, 0));
        $this->top_3            = $this->parseInteger(array_get($lifetime_stats, self::STATS_CODE_TOP_3, 0));
        $this->top_5            = $this->parseInteger(array_get($lifetime_stats, self::STATS_CODE_TOP_5, 0));
        $this->top_6            = $this->parseInteger(array_get($lifetime_stats, self::STATS_CODE_TOP_6, 0));
        $this->top_10           = $this->parseInteger(array_get($lifetime_stats, self::STATS_CODE_TOP_10, 0));
        $this->top_12           = $this->parseInteger(array_get($lifetime_stats, self::STATS_CODE_TOP_12, 0));
        $this->top_25           = $this->parseInteger(array_get($lifetime_stats, self::STATS_CODE_TOP_25, 0));

        $this->calculateScorePerMatch();
        $this->calculateKillsPerMatch();
    }

    /**
     * Convert the raw lifetime stats from the API into an array of key -> value pairs
     * Ready for converting to Stats
     * @param $stats
     * @return array
     */
    private function parseStatsArray($stats) {
        $parsed_stats = [];

        foreach ($stats as $stat) {
            $key = data_get($stat, 'key');
            $value = data_get($stat, 'value');

            if (!is_null($key) && !is_null($value)) {
                $parsed_stats[$key] = $value;
            }
        }

        return $parsed_stats;
    }

}
