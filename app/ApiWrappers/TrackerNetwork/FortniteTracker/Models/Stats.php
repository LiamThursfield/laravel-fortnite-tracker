<?php

namespace App\ApiWrappers\TrackerNetwork\FortniteTracker\Models;

class Stats {

    // Define the constants for the stats codes
    public const STATS_CODE_MATCHES = 'matches.valueInt';
    public const STATS_CODE_SCORE = 'score.valueInt';
    public const STATS_CODE_SPM = 'scorePerMatch.valueDec';
    public const STATS_CODE_KILLS = 'kills.valueInt';
    public const STATS_CODE_KPM = 'kpg.valueDec';
    public const STATS_CODE_KD = 'kd.valueDec';
    public const STATS_CODE_TOP_1 = 'top1.valueInt';
    public const STATS_CODE_TOP_3 = 'top3.valueInt';
    public const STATS_CODE_TOP_5 = 'top5.valueInt';
    public const STATS_CODE_TOP_6 = 'top6.valueInt';
    public const STATS_CODE_TOP_10 = 'top10.valueInt';
    public const STATS_CODE_TOP_12 = 'top12.valueInt';
    public const STATS_CODE_TOP_25 = 'top25.valueInt';

    protected $matches;
    protected $score;
    protected $score_per_match;
    protected $kills;
    protected $kills_per_match;
    protected $kd;
    protected $top_1;
    protected $top_3;
    protected $top_5;
    protected $top_6;
    protected $top_10;
    protected $top_12;
    protected $top_25;

    /**
     * Stats constructor.
     * @param \stdClass $stats
     */
    public function __construct(\stdClass $stats) {
        $this->matches          = data_get($stats, self::STATS_CODE_MATCHES, 0);
        $this->score            = data_get($stats, self::STATS_CODE_SCORE, 0);
        $this->score_per_match  = data_get($stats, self::STATS_CODE_SPM, 0);
        $this->kills            = data_get($stats, self::STATS_CODE_KILLS, 0);
        $this->kills_per_match  = data_get($stats, self::STATS_CODE_KPM, 0);
        $this->kd               = data_get($stats, self::STATS_CODE_KD, 0);
        $this->top_1            = data_get($stats, self::STATS_CODE_TOP_1, 0);
        $this->top_3            = data_get($stats, self::STATS_CODE_TOP_3, 0);
        $this->top_5            = data_get($stats, self::STATS_CODE_TOP_5, 0);
        $this->top_6            = data_get($stats, self::STATS_CODE_TOP_6, 0);
        $this->top_10           = data_get($stats, self::STATS_CODE_TOP_10, 0);
        $this->top_12           = data_get($stats, self::STATS_CODE_TOP_12, 0);
        $this->top_25           = data_get($stats, self::STATS_CODE_TOP_25, 0);
    }

    /**
     * @return mixed
     */
    public function getMatches() {
        return $this->matches;
    }

    /**
     * @return mixed
     */
    public function getScore() {
        return $this->score;
    }

    /**
     * @return mixed
     */
    public function getScorePerMatch() {
        return $this->score_per_match;
    }

    /**
     * @return mixed
     */
    public function getKills() {
        return $this->kills;
    }

    /**
     * @return mixed
     */
    public function getKillsPerMatch() {
        return $this->kills_per_match;
    }

    /**
     * @return mixed
     */
    public function getKd() {
        return $this->kd;
    }

    /**
     * @return mixed
     */
    public function getTop1() {
        return $this->top_1;
    }

    /**
     * @return mixed
     */
    public function getTop3() {
        return $this->top_3;
    }

    /**
     * @return mixed
     */
    public function getTop5() {
        return $this->top_5;
    }

    /**
     * @return mixed
     */
    public function getTop6() {
        return $this->top_6;
    }

    /**
     * @return mixed
     */
    public function getTop10() {
        return $this->top_10;
    }

    /**
     * @return mixed
     */
    public function getTop12() {
        return $this->top_12;
    }

    /**
     * @return mixed
     */
    public function getTop25() {
        return $this->top_25;
    }



    /**
     * Remove any commas and spaces from a numeric string
     * @param $value
     * @return int
     */
    private function parseNumber($value) {
        $value = str_replace(',', '', $value);
        $value = str_replace(' ', '', $value);

        return $value;
    }

    /**
     * Convert a numeric string to an integer
     * @param $value
     * @return int
     */
    protected function parseInteger($value) {
        return intval($this->parseNumber($value));
    }

    /**
     * Convert a numeric string to a float
     * @param $value
     * @return float
     */
    protected function parseFloat($value) {
        return floatval($this->parseNumber($value));
    }

    /**
     * Calculate the SPM using the score and matches played
     */
    protected function calculateScorePerMatch() {
        if ($this->matches > 0 && $this->score > 0) {
            $this->score_per_match = round($this->score / $this->matches, 2);
        } else {
            $this->score_per_match = 0;
        }
    }

    /**
     * Calculate the KPM using the kills and matches played
     */
    protected function calculateKillsPerMatch() {
        if ($this->matches > 0 && $this->kills > 0) {
            $this->kills_per_match = round($this->kills / $this->matches, 2);
        } else {
            $this->kills_per_match = 0;
        }
    }

}
