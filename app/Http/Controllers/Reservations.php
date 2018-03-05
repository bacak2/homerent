<?php
/**
 *@category Kontroler rezerwacji, aplikacji HOMERENT
 *@author Krzysztof Baca
 *@version 1.0
 */


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Reservations extends Controller
{
    //Site language from database
    protected $language = 1;

    public function __construct()
    {
        $temp = \App::getLocale();
        $language = DB::table('languages')->select('id')->where('language_code',$temp)->first();
        $this->language = $language;
    }
    
    public function firstStep($link){

        return view('reservation.firstStep');

    }

}
