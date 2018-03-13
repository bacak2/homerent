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
	Route::get('/', 'Apartaments@showIndex')->name('index');

	Auth::routes();

	//Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/apartaments/{link}', 'Apartaments@showApartamentInfo');

	Route::get('/search/{view}','Apartaments@searchApartaments');

	Route::get('/test','Apartaments@showTotalApartamentPrice');
        
    Route::get('/map','Apartaments@showApartamentsOnMap');

	Route::get('/autocomplete','Apartaments@apartamentAutoComplete');

	Route::post('/reservations', [
		'uses' => 'Reservations@firstStep',
		'as' => 'reservations.firstStep'
	]);

	Route::post('/reservations-second-step', [
		'uses' => 'Reservations@secondStep',
		'as' => 'reservations.secondStep'
	]);

	Route::get('/reservations-fourth-step/{link}', [
		'uses' => 'Reservations@fourthStep',
		'as' => 'reservations.fourthStep'
	]);

	Route::get('/reservations-fourth-step/{link}', [
		'uses' => 'Reservations@fourthStep',
		'as' => 'reservations.fourthStep'
	]);

	Route::prefix('/account')->group(function () {
		Route::GET('/data', [
			'uses' => 'Account@index',
			'as' => 'account'
		]);
	});
});