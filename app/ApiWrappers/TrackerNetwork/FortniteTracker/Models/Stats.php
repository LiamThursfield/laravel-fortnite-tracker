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

}
