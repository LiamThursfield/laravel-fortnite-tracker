<?php

namespace App\ApiWrappers\TrackerNetwork\FortniteTracker\Models;

class PlaylistStats extends Stats {
    /** @var Playlist  */
    private $playlist;

    public function __construct(Playlist $playlist, \stdClass $stats) {
        parent::__construct($stats);
        $this->playlist = $playlist;
    }

    /**
     * @return Playlist
     */
    public function getPlaylist() {
        return $this->playlist;
    }

}
