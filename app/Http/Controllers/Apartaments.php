<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartament;

use DB; 

class Apartaments extends Controller
{
    //Generuje widok strony głównej
    public function showIndex()
    {

    	$apartaments = $this->showIndexApartaments();

    	return view('pages.index', ['apartaments' => $apartaments]);
    }



    //Generuje stronę/widok dla poszczególnych apartamentów
    public function showApartamentInfo($id) {

       $apartament = Apartament::getApartamentInfo($id);

       return view('pages.apartaments', ['apartament' => $apartament]);

    }


    //Generuje apartamenty wyświetlane na stronie głównej
    public function showIndexApartaments() {
    	// $apartaments = DB::select('select * from apartaments');
    	 $apartaments = DB::table('apartaments')->get();
    	 return $apartaments;
    }




}
