<?php

namespace App\ApiWrappers\TrackerNetwork\FortniteTracker\Models;

class Match {

    // Define the constants for the match codes
    public const MATCH_CODE_ID = 'id';
    public const MATCH_CODE_DATE_COLLECTED = 'dateCollected';
    public const MATCH_CODE_PLAYLIST = 'playlist';
    public const MATCH_CODE_MATCHES = 'matches';
    public const MATCH_CODE_SCORE = 'score';
    public const MATCH_CODE_KILLS = 'kills';
    public const MATCH_CODE_TOP_1 = 'top1';
    public const MATCH_CODE_TOP_3 = 'top3';
    public const MATCH_CODE_TOP_5 = 'top5';
    public const MATCH_CODE_TOP_6 = 'top6';
    public const MATCH_CODE_TOP_10 = 'top10';
    public const MATCH_CODE_TOP_12 = 'top12';
    public const MATCH_CODE_TOP_25 = 'top25';

    protected $id;
    protected $date_collected;
    /** @var Playlist  */
    protected $playlist;
    protected $matches;
    protected $score;
    protected $score_per_match;
    protected $kills;
    protected $kills_per_match;
    protected $top_1;
    protected $top_3;
    protected $top_5;
    protected $top_6;
    protected $top_10;
    protected $top_12;
    protected $top_25;

    public function __construct(\stdClass $match) {
        $this->id               = data_get($match, self::MATCH_CODE_ID, '');
        $this->date_collected   = data_get($match, self::MATCH_CODE_DATE_COLLECTED, '');
        $this->playlist         = new Playlist(data_get($match, self::MATCH_CODE_PLAYLIST, ''));
        $this->matches          = data_get($match, self::MATCH_CODE_MATCHES, 0);
        $this->score            = data_get($match, self::MATCH_CODE_SCORE, 0);
        $this->kills            = data_get($match, self::MATCH_CODE_KILLS, 0);
        $this->top_1            = data_get($match, self::MATCH_CODE_TOP_1, 0);
        $this->top_3            = data_get($match, self::MATCH_CODE_TOP_3, 0);
        $this->top_5            = data_get($match, self::MATCH_CODE_TOP_5, 0);
        $this->top_6            = data_get($match, self::MATCH_CODE_TOP_6, 0);
        $this->top_10           = data_get($match, self::MATCH_CODE_TOP_10, 0);
        $this->top_12           = data_get($match, self::MATCH_CODE_TOP_12, 0);
        $this->top_25           = data_get($match, self::MATCH_CODE_TOP_25, 0);

        $this->calculateScorePerMatch();
        $this->calculateKillsPerMatch();
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
