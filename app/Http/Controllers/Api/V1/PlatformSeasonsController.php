<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\PlatformSeasonsHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $with_combined_platforms = json_decode($request->get('with_combined_platforms', false));
        return PlatformSeasonsHelper::getActive($with_combined_platforms);
    }


}
