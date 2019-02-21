<?php

namespace App\ApiWrappers\TrackerNetwork\FortniteTracker\Models;

class PlayerStats {

    private $solos_lifetime;
    private $solos_current;
    private $duos_lifetime;
    private $duos_current;
    private $squads_lifetime;
    private $squads_current;

    /**
     * PlayerStats constructor.
     * @param \stdClass $stats
     */
    public function __construct(\stdClass $stats) {
        foreach ($stats as $playlist_code => $raw_stats) {
            $playlist = new Playlist($playlist_code);
            $playlist_stats = new PlaylistStats($playlist, $raw_stats);
            $this->updatePlaylistStats($playlist_stats);

        }
    }

    /**
     * Get an array of all the playlist stats
     * @return PlaylistStats[]
     */
    public function getPlaylistStats() {
        return [
            $this->solos_lifetime,
            $this->solos_current,
            $this->duos_lifetime,
            $this->duos_current,
            $this->squads_lifetime,
            $this->squads_current
        ];
    }

    /**
     * Update the stats for one of the playlists
     * Uses the playlist name and period to determine which to update
     * @param PlaylistStats $playlist_stats
     */
    private function updatePlaylistStats(PlaylistStats $playlist_stats) {
        // Determine which stat should be updated
        $method_name = 'set';
        $method_name .= ucfirst($playlist_stats->getPlaylist()->getPlaylistName());
        $method_name .= ucfirst($playlist_stats->getPlaylist()->getPlaylistPeriod());
        $method_name .= 'Stats';

        if (method_exists($this, $method_name)) {
            $this->$method_name($playlist_stats);
        }
    }

    /**
     * Set the stats for the Lifetime Solos Playlist
     * @param $playlist_stats
     */
    private function setSolosLifetimeStats($playlist_stats) {
        $this->solos_lifetime = $playlist_stats;
    }

    /**
     * Set the stats for the Current Season Solos Playlist
     * @param $playlist_stats
     */
    private function setSolosCurrentStats($playlist_stats) {
        $this->solos_current = $playlist_stats;
    }

    /**
     * Set the stats for the Lifetime Duos Playlist
     * @param $playlist_stats
     */
    private function setDuosLifetimeStats($playlist_stats) {
        $this->duos_lifetime = $playlist_stats;
    }

    /**
     * Set the stats for the Current Season Duos Playlist
     * @param $playlist_stats
     */
    private function setDuosCurrentStats($playlist_stats) {
        $this->duos_current = $playlist_stats;
    }

    /**
     * Set the stats for the Lifetime Squads Playlist
     * @param $playlist_stats
     */
    private function setSquadsLifetimeStats($playlist_stats) {
        $this->squads_lifetime = $playlist_stats;
    }

    /**
     * Set the stats for the Current Season Squads Playlist
     * @param $playlist_stats
     */
    private function setSquadsCurrentStats($playlist_stats) {
        $this->squads_current = $playlist_stats;
    }

}
