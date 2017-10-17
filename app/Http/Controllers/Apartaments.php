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
use App\Reservation;

use DB; 

class Apartaments extends Controller
{

  
    //Język strony z bazy danych
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
       return view('pages.apartaments', ['apartament' => $apartament,
                                         'groups' => $groups
                                        ]);

    }

    //Wyszukiwarka apartamentów
    public function searchApartaments(Request $request) {

        $region = $request->input('region');
        $arriveDate = $request->input('przyjazd');
        $returnDate = $request->input('powrot');

        DB::connection()->enableQueryLog();   

        $finds = DB::Table('apartaments')
                ->join('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
                ->join('languages', function($join) {
                        $join->on('apartament_descriptions.language_id','=','languages.id')
                            ->where('languages.id', $this->language->id);
                  })
                ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
                ->where('apartaments.apartament_address',$region)
                ->orWhere('apartaments.apartament_city',$region)
                ->where(function($query) {
                    $query->WhereNull('reservation_arrive_date')
                          ->WhereNull('reservation_departure_date');

                })
                ->orWhere(function($query) use($arriveDate,$returnDate){
                    $query->WhereNotBetween('reservation_arrive_date',[$arriveDate,$returnDate])
                          ->WhereNotBetween('reservation_departure_date',[$arriveDate,$returnDate]);
                })


                ->get(); 

        $counted = count($finds);
       // dd($finds);

      //  dd(DB::getQueryLog());

        return view('pages.results', [  'region' => $region,
                                        'arive_date' => $arriveDate,
                                        'return_date' => $returnDate,
                                        'finds' => $finds,
                                        'counted' => $counted,
                                     ]);
    }


    public function showTotalApartamentPrice(Request $request)
    {
        $przyjazd = $request->input('przyjazd');
        $powrot = $request->input('powrot');
        $id = $request->input('id');

        $dprz = strtotime($przyjazd);
        $dpwr = strtotime($powrot);
        $nightsCounter = ($dpwr - $dprz)/(60 * 60 * 24);

        //Sprawdza dostępność danego apartamentu w wybranym terminie przesłanym przez Ajax JS
        $availabity = DB::Table('apartaments')
                        ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
                        ->where('apartaments.id','=',$id)
                        ->where(function($query) {
                            $query->WhereNull('reservation_arrive_date')
                                  ->WhereNull('reservation_departure_date');

                        })
                        ->orWhere(function($query) use($przyjazd,$powrot){
                            $query->WhereNotBetween('reservation_arrive_date',[$przyjazd,$powrot])
                                  ->WhereNotBetween('reservation_departure_date',[$przyjazd,$powrot]);
                        })                        
                        ->get();

        $is_available= TRUE;

        if(count($availabity) == 1) {
            $is_available = TRUE;

        }   
        else  {
            $is_available = FALSE;

        }

        return response()->json([   'days_number' => $nightsCounter,
                                    'price' => 21,
                                    'is_available' => $is_available,
        ]);
    }

}
