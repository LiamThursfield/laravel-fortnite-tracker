<?php

namespace App\ApiWrappers\TrackerNetwork\FortniteTracker\Models;

class PlayerStats {

    private $solos_lifetime;
    private $solos_current;
    private $duos_lifetime;
    private $duos_current;
    private $squads_lifetime;
    private $squads_current;

    public function __construct(\stdClass $stats) {
        foreach ($stats as $playlist_code => $raw_stats) {
            $playlist = new Playlist($playlist_code);
            $playlist_stats = new PlayerPlaylistStats($playlist, $raw_stats);
            $this->updatePlaylistStats($playlist_stats);

        }
    }

    private function updatePlaylistStats(PlayerPlaylistStats $playlist_stats) {
        // Determine which stat should be updated
        $method_name = 'set';
        $method_name .= ucfirst($playlist_stats->getPlaylist()->getPlaylistName());
        $method_name .= ucfirst($playlist_stats->getPlaylist()->getPlaylistPeriod());
        $method_name .= 'Stats';

        if (method_exists($this, $method_name)) {
            $this->$method_name($playlist_stats);
        }
    }

    private function setSolosLifetimeStats($playlist_stats) {
        $this->solos_lifetime = $playlist_stats;
    }

    private function setSolosCurrentStats($playlist_stats) {
        $this->solos_current = $playlist_stats;
    }

    private function setDuosLifetimeStats($playlist_stats) {
        $this->duos_lifetime = $playlist_stats;
    }

    private function setDuosCurrentStats($playlist_stats) {
        $this->duos_current = $playlist_stats;
    }

    private function setSquadsLifetimeStats($playlist_stats) {
        $this->squads_lifetime = $playlist_stats;
    }

    private function setSquadsCurrentStats($playlist_stats) {
        $this->squads_current = $playlist_stats;
    }

}
