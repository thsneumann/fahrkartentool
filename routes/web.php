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

// APP

Route::get('/map', 'MapController@index')->name('map.index');
Route::get('/', function() {
    return redirect(route('map.index'));
});

// ADMIN

Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index');
Route::group(['prefix' => 'admin'], function () {
    Route::resource('tickets', 'TicketsController');
    Route::resource('locations', 'LocationsController');
});

// API
// todo: move to api.php && require login
Route::group(['prefix' => 'api', 'namespace' => 'Api', 'as' => 'api.'], function () {
    Route::resource('tickets', 'TicketsController');
    Route::resource('locations', 'LocationsController');
    Route::get('/locations/{location}/outgoing', 'LocationsController@outgoing')->name('locations.outgoing');
});