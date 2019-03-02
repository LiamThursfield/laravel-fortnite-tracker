<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\PlayerPlaylistStatsHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlaylistStatsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('cors');
    }

    /**
     * Get the cumulative player playlist stats
     * By platform, season, and playlist
     * @param $platform
     * @param $season
     * @param $playlist
     *
     * @return array
     */
    public function index($platform, $season, $playlist) {
        return PlayerPlaylistStatsHelper::getCumulativeStats($platform, $season, $playlist);
    }
}
