<?php
/**
 * Created by PhpStorm.
 * User: adminartplus
 * Date: 29.05.18
 * Time: 09:02
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Session;

class Owners extends Controller
{
    //Site language from database
    protected $language = 1;

    public function __construct()
    {
        $temp = \App::getLocale();
        $language = DB::table('languages')->select('id', 'language_code')->where('language_code',$temp)->first();
        $this->language = $language;
        if ($this->language->id == 1) setlocale(LC_TIME, "pl_PL");
        else setlocale(LC_TIME, "en_EN");
    }

    public function index(){
        return view('owners.main');
    }

    public function firstStep(){
        return view('owners.first-step');
    }

    //Ajax autoComplete, returns json
    public function citiesAutoComplete(Request $request)
    {

        $phrase = $request->input('phrase');

        $apartaments = DB::table('cities')
            ->select('city', DB::raw('CONCAT("woj. ", voivodeship) AS voivodeship'))
            ->where('city','like','%'.$phrase.'%')->get();

        return response(json_encode($apartaments));
    }

}