<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\PlatformHelper;
use App\Helpers\PlayerPlaylistStatsHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Mockery\Exception;

class PlatformSeasonsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('cors');
    }

    /**
     * Get the Platforms and Seasons with active players
     * @param Request $request
     * @return array
     */
    public function index(Request $request) {

        // If Combined platforms is an option, add it to the array
        if ($request->has('with_combined')) {
            $platforms = ['combined' => 'Combined'];
        } else {
            $platforms = [];
        }
        foreach (PlatformHelper::getAllPlatforms() as $platform) {
            $platforms[$platform->id] = $platform->platform_friendly;
        }

        $seasons = PlayerPlaylistStatsHelper::getActiveSeasons();

        return compact('platforms', 'seasons');
    }


}
