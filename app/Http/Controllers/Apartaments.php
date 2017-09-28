<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartament;
use App\Apartament_description;

use DB; 

class Apartaments extends Controller
{
    //Generuje widok strony głównej
    public function showIndex()
    {

        $apartaments = Apartament::all();
    	return view('pages.index', ['apartaments' => $apartaments]);

    }


    //Generuje stronę/widok dla poszczególnych apartamentów
    public function showApartamentInfo($id) {

       $apartament = Apartament::where('id', $id)->first();

       $descriptions = Apartament_description::find(1)->descriptions;
       dd($descriptions);
       return view('pages.apartaments', ['apartament' => $apartament,
        'description' => $descriptions
        ]);

    }






}
