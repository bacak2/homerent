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

	$Imie = "Homerent";

    return view('welcome', ['name' => $Imie]);
});



//Route::redirect('/apartaments', 'http://www.interia.pl/', 301);