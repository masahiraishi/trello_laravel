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

Route::get('/','ListingController@index');
Route::get('/new','ListingController@new')->name('new');
Route::post('/listings','ListingController@store');
Route::get('/listingsedit/{listing_id}', 'ListingController@edit');
Route::post('/listing/edit','ListingController@update');
Route::get('/listingsdselete/{listing_id}', 'ListingController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
