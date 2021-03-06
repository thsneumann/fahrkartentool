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

// PAGES

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/intro', function() {
    return view('intro');
})->name('intro');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/imprint', function () {
    return view('imprint');
})->name('imprint');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');


// EDIT

Route::group(['prefix' => 'edit'], function () {
    Route::get('/', 'EditController@index')->name('edit.index');
    Route::get('highscore', 'EditController@highscore')->name('edit.highscore');
});

// EXPLORE

Route::get('/explore', 'ExploreController@index')->name('explore.index');
Route::get('/map', 'MapController@index')->name('map');
Route::resource('tickets', 'TicketsController');
Route::resource('locations', 'LocationsController');
Route::get('locations/{location}/popup', 'LocationsController@showPopup')->name('locations.popup');
Route::resource('categories', 'CategoriesController');

// ADMIN

Route::get('/admin', 'AdminController@index')->name('admin');
Route::post('/admin', 'AdminController@toggle')->name('admin.toggle');

// AUTH

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/delete-account', 'Auth\DeleteAccountController@index')->name('delete-account.index');
Route::post('/delete-account', 'Auth\DeleteAccountController@delete')->name('delete-account.delete');

