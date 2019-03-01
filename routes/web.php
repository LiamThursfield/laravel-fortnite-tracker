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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/solos', 'HomeController@index')->name('solos');
Route::get('/duos', 'HomeController@index')->name('duos');
Route::get('/squads', 'HomeController@index')->name('squads');
