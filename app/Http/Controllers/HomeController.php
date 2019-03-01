<?php

namespace App\Http\Controllers;

use App\Helpers\PlayerLifetimeStatsHelper;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){}

    /**
     * Show the home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $player_stats = PlayerLifetimeStatsHelper::getAllPlayersCumulative();
        return view('home')->with(compact('player_stats'));
    }
}
