<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Apartaments extends Controller
{
    //Generuje widok strony głównej
    public function showIndex()
    {
    	return view('pages.index');
    }

}
