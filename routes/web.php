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
        //'prefix' => LaravelLocalization::setLocale(),
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],

    function()
    {
        Route::get('/', 'Apartaments@showIndex')->name('index');

        Route::post('logout', 'Auth\LoginController@logout');

        Route::view('/regulations', 'pages.regulations');

        Auth::routes();

        Route::get('/home', 'HomeController@index')->name('home');

        Route::get('/apartaments/{link}', 'Apartaments@showApartamentInfo')->name('apartamentInfo');

        Route::get('/apartaments-group/{link}', 'Apartaments@showApartamentGroup')->name('apartamentGroup');

        Route::get('/search/{view}','Apartaments@searchApartaments');

        Route::get('/test','Apartaments@showTotalApartamentPrice');

        Route::get('/checkGroup','Apartaments@checkGroupAvailability');

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

        Route::GET('/reservations-fourth-step/{idAparment}/{idReservation}', [
            'uses' => 'Reservations@fourthStep',
            'as' => 'reservations.fourthStep'
        ]);

        Route::POST('/after-online-payment', [
            'uses' => 'Reservations@AfterOnlinePayment',
            'as' => 'reservations.afterOnlinePaymentPOST'
        ]);

        Route::POST('/reservations-fourth-step/{idAparment}/{idReservation}', [
            'uses' => 'Reservations@fourthStep',
            'as' => 'reservations.fourthStepAfterDotpay'
        ]);

        Route::get('/services/{idAparment}/{idReservation}/{idService}', [
            'uses' => 'Services@firstStep',
            'as' => 'services.firstStep'
        ]);

        Route::POST('/services-second-step', [
            'uses' => 'Services@secondStep',
            'as' => 'services.secondStep'
        ]);

        Route::POST('/services-third-step', [
            'uses' => 'Services@thirdStep',
            'as' => 'services.thirdStep'
        ]);

        Route::GET('/services-fourth-step/{idAparment}/{idReservation}', [
            'uses' => 'Services@fourthStep',
            'as' => 'services.fourthStep'
        ]);

        Route::POST('/services-fourth-step/{idAparment}/{idReservation}', [
            'uses' => 'Services@fourthStep',
            'as' => 'services.fourthStepAfterDotpay'
        ]);

        Route::POST('/opinion-added', [
            'uses' => 'Opinions@addOpinion',
            'as' => 'opinions.addOpinion'
        ]);

        Route::GET('/sendemail', [
            'uses' => 'Reservations@SendMail',
            'as' => 'reservations.SendMail'
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

            Route::GET('/my-opinons', [
                'uses' => 'Account@opinions',
                'as' => 'myOpinions'
            ]);

            Route::GET('/getOpinionDetails/{idAparment}/{reservationId}','Account@getOpinionDetails');

            Route::GET('/my-reservations/{idAparment}/{idReservation}', [
                'uses' => 'Account@reservationDetail',
                'as' => 'account.reservationDetail'
            ]);

            Route::GET('/my-reservations/{idAparment}/{idReservation}/opinion', [
                'uses' => 'Account@reservationOpinion',
                'as' => 'account.opinion'
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