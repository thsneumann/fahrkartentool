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

// HOME

Route::get('/', function () {
    return view('home');
})->name('home');

// GAME

Route::group(['prefix' => 'game'], function () {
    Route::get('/', 'GameController@index')->name('game.index');
    Route::get('/tagging', 'GameController@tagging')->name('game.tagging');
    Route::get('/add-location', 'GameController@addLocation')->name('game.add-location');
});

// EXPLORE

Route::get('/map', 'MapController@index')->name('map.index');
Route::resource('tickets', 'TicketsController');
Route::resource('locations', 'LocationsController');
Route::get('locations/{location}/popup', 'LocationsController@showPopup')->name('locations.popup');
Route::resource('tags', 'TagsController');

// API
// TODO: move to api.php && require login
Route::group(['prefix' => 'api', 'namespace' => 'Api', 'as' => 'api.'], function () {
    Route::resource('tickets', 'TicketsController');
    Route::resource('locations', 'LocationsController');
    Route::get('locations/{location}/outgoing', 'LocationsController@outgoing')->name('locations.outgoing');
});
