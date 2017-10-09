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
    protected $language = 1; 

     public function __construct()
      {
        $temp = \App::getLocale();
        $language = DB::table('languages')->select('id')->where('language_code',$temp)->first();
        $this->language = $language;
      }
    


    //Generuje widok strony głównej
    public function showIndex()
    {

        $apartaments = Apartament::with(array('descriptions' => function($query){
                        $query->where('language_id', $this->language->id);
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
                    $query->where('language_id', $this->language->id);
                }))->find($id);
    
        $apartamentGroup = DB::table('apartaments')->select('group_id')->where('id',$id)->pluck('group_id');

        //Generuje podobne apartamenty na podstawie grupy w której znajduje się dany apartament
        $groups =  DB::table('apartaments')
                    ->join('apartament_groups', 'apartaments.group_id', '=', 'apartament_groups.id')
                    ->join('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
                    ->join('languages', function($join) {
                        $join->on('apartament_descriptions.language_id','=','languages.id')
                            ->where('languages.id', $this->language->id);
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

    public function searchApartaments(Request $request) {

        $test = $request->input('region');
        $test2 = $request->input('przyjazd');


        return view('pages.results', [  'test' => $test,
                                        'test2' => $test2,
                                     ]);
    }




}
