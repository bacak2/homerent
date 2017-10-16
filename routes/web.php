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


Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],
function()
{
	Route::get('/', 'Apartaments@showIndex');

	Auth::routes();

	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/apartaments/{id}', 'Apartaments@showApartamentInfo');

	Route::get('/search','Apartaments@searchApartaments');

	Route::get('/test','Apartaments@showTotalApartamentPrice');
});