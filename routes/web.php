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

	Route::get('/apartaments/{link}', 'Apartaments@showApartamentInfo')->name('apartamentInfo');

	Route::get('/search/{view}','Apartaments@searchApartaments');

	Route::get('/test','Apartaments@showTotalApartamentPrice');
        
    Route::get('/map','Apartaments@showApartamentsOnMap');

	Route::get('/autocomplete','Apartaments@apartamentAutoComplete');

	Route::get('/reservations', [
		'uses' => 'Reservations@firstStep',
		'as' => 'reservations.firstStep'
	]);

	Route::get('/reservations-second-step', [
		'uses' => 'Reservations@secondStep',
		'as' => 'reservations.secondStep'
	]);

	Route::POST('/reservations-third-step', [
		'uses' => 'Reservations@thirdStep',
		'as' => 'reservations.thirdStep'
	]);

	Route::get('/reservations-fourth-step/{idAparment}/{idReservation}', [
		'uses' => 'Reservations@fourthStep',
		'as' => 'reservations.fourthStep'
	]);

	Route::prefix('/account')->group(function () {
		Route::GET('/data', [
			'uses' => 'Account@index',
			'as' => 'account'
		]);

		Route::GET('/my-favourites', [
			'uses' => 'Account@favourites',
			'as' => 'myFavourites'
		]);

		Route::GET('/my-reservations', [
			'uses' => 'Account@reservations',
			'as' => 'myReservations'
		]);

		Route::GET('/my-reservations/{idAparment}/{idReservation}', [
			'uses' => 'Account@reservationDetail',
			'as' => 'account.reservationDetail'
		]);

		Route::GET('/save','Account@save');
		
		Route::GET('/refreshView','Account@refreshView');
		
		Route::GET('/edit/{id}', [
			'uses' => 'Account@editItem',
			'as' => 'Account.edit'
		]);
		
		Route::GET('/delete/{id}', [
			'uses' => 'Account@deleteItem',
			'as' => 'Account.delete'
		]);
	});
});