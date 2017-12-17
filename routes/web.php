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


Auth::routes();

Route::get('/', 'HomeController@index');
//Route::get('/home', 'HomeController@index')->name('home');

Route::post('/search','SearchController@search')->name('search');
Route::get('/search/{uri}','SearchController@single')->name('search.single');
Route::post('/addfavourites','FavouriteController@store')->name('add.favourites');
Route::get('/favourites','FavouriteController@index')->name('view.favourites');
Route::delete('/favourites','FavouriteController@destroy')->name('delete.favourites');