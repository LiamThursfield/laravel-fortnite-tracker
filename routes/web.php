<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PlayerPlaylistStatsController@all')->name('home');
Route::get('/solos', 'PlayerPlaylistStatsController@solos')->name('solos');
Route::get('/duos', 'PlayerPlaylistStatsController@duos')->name('duos');
Route::get('/squads', 'PlayerPlaylistStatsController@squads')->name('squads');
