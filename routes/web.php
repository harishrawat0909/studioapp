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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/get-studios/{condition}/{query?}', 'StudioController@getStudios');
Route::get('/get-studio/{studioId}', 'StudioController@getStudio');
Route::get('/check-studio-availability/{slotId}', 'StudioController@checkStudioAvailablity');
Route::post('/book-studio', 'StudioController@bookStudio');
Route::get('/search-studios/{condition}/{query?}', 'StudioController@searchStudios');