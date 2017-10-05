<?php
/**
 *@category Kontroler apartamentów, aplikacji HOMERENT
 *@author Arkadiusz Adamczyk - ARTPLUS
 *@version 1.0
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartament;
use App\Apartament_description;
use App\Apartament_group;

use DB; 

class Apartaments extends Controller
{
    //Język strony
    private $language = 1;

    //Generuje widok strony głównej
    public function showIndex()
    {
        
        $apartaments = Apartament::with(array('descriptions' => function($query){
                        $query->where('language_id', $this->language);
                        }))
                        ->get();

       // dd($apartaments);

    	return view('pages.index', ['apartaments' => $apartaments]);

    }


    //Generuje stronę/widok dla poszczególnych apartamentów
    public function showApartamentInfo($id) {
       // DB::enableQueryLog();

        $apartament = Apartament::with(array('descriptions' => function($query)
                {
                    $query->where('language_id', $this->language);
                }))->find($id);
    
        $apartamentGroup = DB::table('apartaments')->select('group_id')->where('id',$id)->pluck('group_id');

        //Generuje podobne apartamenty na podstawie grupy w której znajduje się dany apartament
        $groups =  DB::table('apartaments')
                    ->join('apartament_groups', 'apartaments.group_id', '=', 'apartament_groups.id')
                    ->join('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
                    ->join('languages', function($join) {
                        $join->on('apartament_descriptions.language_id','=','languages.id')
                            ->where('languages.id', $this->language);
                    })
                    ->where('apartaments.group_id',$id)
                    ->limit(3)  // Maksymalnie 3 apartamenty
                    ->get();


       // dd($groups); 
       // dd($descriptions);
       // dd(DB::getQueryLog());
       return view('pages.apartaments', ['apartament' => $apartament,
                                         'groups' => $groups
                                        ]);

    }

    public function searchApartaments() {
        return view('pages.results');
    }




}
