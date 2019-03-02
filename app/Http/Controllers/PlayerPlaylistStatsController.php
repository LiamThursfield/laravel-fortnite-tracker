<?php

namespace App\Http\Controllers;

class PlayerPlaylistStatsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){}

    /**
     * Show the Player Stats for all playlists.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function all() {
        $playlist_type = 'all';
        return view('player_playlist_stats')->with(compact('playlist_type'));
    }

    /**
     * Show the Player Stats for the solos playlist.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function solos() {
        $playlist_type = 'solos';
        return view('player_playlist_stats')->with(compact('playlist_type'));
    }

    /**
     * Show the Player Stats for the duos playlist.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function duos() {
        $playlist_type = 'duos';
        return view('player_playlist_stats')->with(compact('playlist_type'));
    }

    /**
     * Show the Player Stats for the squads playlist.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function squads() {
        $playlist_type = 'squads';
        return view('player_playlist_stats')->with(compact('playlist_type'));
    }
}
