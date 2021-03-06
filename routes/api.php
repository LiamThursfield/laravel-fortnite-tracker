<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

// Controllers Within The "App\Http\Controllers\Admin" Namespace
Route::namespace('Api\V1')
    ->prefix('v1')
    ->group(function () {

    Route::get('/platform_seasons', 'PlatformSeasonsController@index');
    Route::get('playlist_stats/{platform}/{season}/{playlist}', 'PlaylistStatsController@index');

});
