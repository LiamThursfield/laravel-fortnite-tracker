<?php

namespace App\ApiWrappers\TrackerNetwork\FortniteTracker\Models;

class PlayerProfile {

    /** @var string */
    private $epic_username;
    /** @var string */
    private $account_id;
    /** @var Platform  */
    private $platform;
    /** @var PlayerStats  */
    private $player_stats;
    /** @var LifetimeStats */
    private $lifetime_stats;
    /** @var Match[] */
    private $recent_matches;

    /**
     * PlayerProfile constructor.
     * @param \stdClass $profile
     * @throws \Exception
     */
    public function __construct(\stdClass $profile) {
        if (!self::isRawProfileValid($profile)) {
            throw new \Exception('Player Profile is invalid');
        }

        $this->epic_username = $profile->epicUserHandle;
        $this->account_id = $profile->accountId;
        $this->platform = new Platform($profile->platformId);
        $this->player_stats = new PlayerStats($profile->stats);
        $this->lifetime_stats = new LifetimeStats($profile->lifeTimeStats);
        $this->parseRawRecentMatches($profile->recentMatches);
    }

    /**
     * Determine if the profile returned from the API is valid
     * @param \stdClass $profile
     * @return bool
     */
    private static function isRawProfileValid(\stdClass $profile) {
        if (!isset($profile->epicUserHandle)) { return false; }
        if (!isset($profile->accountId)) { return false; }
        if (!isset($profile->platformId)) { return false; }
        if (!isset($profile->stats)) { return false; }
        if (!isset($profile->lifeTimeStats)) { return false; }
        if (!isset($profile->recentMatches)) { return false; }
        return true;
    }

    /**
     * Convert the raw recent matches returned from the API into an array of Match objects
     * @param array $recent_matches
     */
    private function parseRawRecentMatches($recent_matches) {
        $this->recent_matches = [];

        if (is_array($recent_matches) && count($recent_matches)) {
            foreach ($recent_matches as $recent_match) {
                $this->recent_matches[] = new Match($recent_match);
            }
        }
    }

}
