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


Route::get('/','PlaylistController@home');

//Playlist Routes
Route::get('playlists','PlaylistController@index');
Route::get('playlists/new','PlaylistController@create');
Route::post('playlists/new','PlaylistController@store');
Route::get('playlists/{id?}','PlaylistController@show');
Route::get('playlists/{id?}/edit','PlaylistController@edit');
Route::put('playlists/{id?}/edit','PlaylistController@update');


//Song Routes
Route::get('playlists/{id?}/songs/add','SongsController@add');
Route::post('playlists/{id?}/songs/add','SongsController@store');
Route::delete('songs/{id?}','SongsController@destroy');

Route::get('auth/logout','Auth\LoginController@logout');
Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
