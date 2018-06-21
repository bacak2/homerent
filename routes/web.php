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

        Route::post('logout', 'Auth\LoginController@logout');

        Route::view('/regulations', 'pages.regulations');

        Route::view('/privacy-policy', 'pages.privacyPolicy');

        Auth::routes();

        Route::get('/home', 'HomeController@index')->name('home');

        Route::get('/apartaments/{link}', 'Apartaments@showApartamentInfo')->name('apartamentInfo');

        Route::get('/apartaments-group/{link}', 'Apartaments@showApartamentGroup')->name('apartamentGroup');

        Route::get('/search/{view}','Apartaments@searchApartaments');

        Route::get('/test','Apartaments@showTotalApartamentPrice');

        Route::get('/increaseHelpful','Apartaments@increaseHelpful');

        Route::get('/addToFavourites/{apartmentId}/{userId}','Favourites@addToFavourites');

        Route::get('/truncateFavourites/{userId}','Favourites@truncateFavourites');

        Route::get('/deleteFromFavourites/{apartmentId}/{userId}','Favourites@deleteFromFavourites');

        Route::get('/checkGroup','Apartaments@checkGroupAvailability');

        Route::get('/map','Apartaments@showApartamentsOnMap');

        Route::get('/autocomplete','Apartaments@apartamentAutoComplete');

        Route::get('/autocompleteCities','Owners@citiesAutoComplete');

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

        Route::GET('/sendContactForm', [
            'uses' => 'AboutUs@SendMail',
            'as' => 'aboutUs.SendMail'
        ]);

        Route::GET('/for-owners', [
            'uses' => 'Owners@index',
            'as' => 'owners.index'
        ]);

        Route::GET('/for-owners/first-step', [
            'uses' => 'Owners@firstStep',
            'as' => 'owners.firstStep'
        ]);

        Route::GET('/for-travelers', [
            'uses' => 'Travelers@index',
            'as' => 'travelers.index'
        ]);

        Route::GET('/about-us', [
            'uses' => 'AboutUs@index',
            'as' => 'aboutUs.index'
        ]);

        Route::GET('/media', [
            'uses' => 'AboutUs@media',
            'as' => 'aboutUs.media'
        ]);

        Route::GET('/media-download/{name}/{extension}', [
            'uses' => 'AboutUs@getDownload',
            'as' => 'aboutUs.getDownload'
        ]);

        Route::GET('/news', [
            'uses' => 'AboutUs@news',
            'as' => 'aboutUs.news'
        ]);

        Route::GET('/news/{newsId}', [
            'uses' => 'AboutUs@newsDetail',
            'as' => 'aboutUs.newsDetail'
        ]);

        Route::GET('/contact', [
            'uses' => 'AboutUs@contact',
            'as' => 'aboutUs.contact'
        ]);

        Route::GET('/contact/{faqToShow}', [
            'uses' => 'AboutUs@faq',
            'as' => 'aboutUs.faq'
        ]);

        Route::view('/resources-to-download', 'about-us.resources');

        Route::view('/guidebooks', 'guidebooks.index');

        Route::GET('/guidebooks/{guidebookId}', [
            'uses' => 'AboutUs@guidebookDetail',
            'as' => 'aboutUs.guidebookDetail'
        ]);

        Route::GET('/send-news-to-friends', [
            'uses' => 'AboutUs@sendMailWithNews',
            'as' => 'aboutUs.sendMailWithNews'
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

            Route::GET('/my-favourites-list', [
                'uses' => 'Account@favourites',
                'as' => 'myFavouritesList'
            ]);

            Route::GET('/my-favourites-map', [
                'uses' => 'Account@favourites',
                'as' => 'myFavouritesMap'
            ]);

            Route::GET('/my-favourites-compare', [
                'uses' => 'Account@favourites',
                'as' => 'myFavouritesCompare'
            ]);

            Route::GET('/my-reservations', [
                'uses' => 'Account@reservations',
                'as' => 'myReservations'
            ]);

            Route::GET('/my-opinons', [
                'uses' => 'Account@opinions',
                'as' => 'myOpinions'
            ]);

            Route::GET('/my-opinons-to-add', [
                'uses' => 'Account@opinionsToAdd',
                'as' => 'myOpinionsToAdd'
            ]);

            Route::GET('/getOpinionDetails/{idAparment}/{reservationId}','Account@getOpinionDetails');

            Route::GET('/opinion/{reservationId}','Opinions@deleteOpinion');

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

            Route::GET('/send-email-to-friends', [
                'uses' => 'Account@sendMail',
                'as' => 'account.sendMail'
            ]);
        });
    });