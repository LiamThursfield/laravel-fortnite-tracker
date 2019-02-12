<?php

namespace App\ApiWrappers\TrackerNetwork\FortniteTracker\Models;

class Playlist {

    // Define the constants for playlist codes
    public static const PLAYLIST_CODE_SOLOS = 'p2';
    public static const PLAYLIST_CODE_DUOS = 'p10';
    public static const PLAYLIST_CODE_SQUADS = 'p9';

    // Define the constant for the prefix defining the current season
    public static const PLAYLIST_CODE_CURRENT_PREFIX = 'curr';

    // Define the constants for the playlist names
    public static const PLAYLIST_NAME_SOLOS = 'Solos';
    public static const PLAYLIST_NAME_DUOS = 'Duos';
    public static const PLAYLIST_NAME_SQUADS = 'Squads';

    // Define the constants for the playlist periods
    public static const PLAYLIST_PERIOD_CURRENT = 'Current';
    public static const PLAYLIST_PERIOD_LIFETIME = 'Lifetime';

    private $playlist_code;
    private $playlist_name;
    private $playlist_period; // Current season / Lifetime

    public function __construct(string $playlist_code) {
        $this->playlist_code = $playlist_code;
        $this->convertCode();
    }

    /**
     * Convert the raw playlist code from the API into a playlist name and period
     */
    private function convertCode() {
        $code_array = explode($this->playlist_code, '_');

        // Lifetime playlist
        if (count($code_array) == 1) {
            $this->getPlaylistNameFromCode($code_array[0]);
            $this->playlist_period = self::PLAYLIST_PERIOD_LIFETIME;
        }
        // Current season playlist
        else if (count($code_array) == 2) {
            $this->getPlaylistNameFromCode($code_array[1]);
            $this->getPlaylistPeriodFromCode($code_array[0]);
        }
        // Unknown playlist
        else {
            $this->getPlaylistNameFromCode($this->playlist_code);
            $this->getPlaylistPeriodFromCode($this->playlist_code);
        }
    }

    /**
     * Convert the name portion of a playlist code into a playlist name
     * Or set as an unknown code
     * @param null|string $code
     */
    private function getPlaylistNameFromCode($code = null) {
        switch ($code) {
            case self::PLAYLIST_CODE_SOLOS:
                $this->playlist_name = self::PLAYLIST_NAME_SOLOS;
                break;
            case self::PLAYLIST_CODE_DUOS:
                $this->playlist_name = self::PLAYLIST_NAME_DUOS;
                break;
            case self::PLAYLIST_CODE_SQUADS:
                $this->playlist_name = self::PLAYLIST_NAME_SQUADS;
                break;
            default:
                $this->playlist_name = "Unknown: {$code}";
        }
    }

    /**
     * Convert the period portion of a playlist code into a playlist period
     * Or set as an unknown code
     * @param null|string $code
     */
    private function getPlaylistPeriodFromCode($code = null) {
        switch ($code) {
            case self::PLAYLIST_CODE_CURRENT_PREFIX:
                $this->playlist_code = self::PLAYLIST_PERIOD_CURRENT;
                break;
            default:
                $this->playlist_code = "Unknown: {$code}";
        }
    }

    /**
     * @return string
     */
    public function getPlaylistCode() {
        return $this->playlist_code;
    }

    /**
     * @return string
     */
    public function getPlaylistName() {
        return $this->playlist_name;
    }

    /**
     * @return string
     */
    public function getPlaylistPeriod() {
        return $this->playlist_period;
    }


}
