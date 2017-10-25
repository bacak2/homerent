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

use Illuminate\Support\Facades\DB;

class Apartaments extends Controller
{

  
    //Site language from database
    protected $language = 1; 

     public function __construct()
      {
        $temp = \App::getLocale();
        $language = DB::table('languages')->select('id')->where('language_code',$temp)->first();
        $this->language = $language;
      }
    


    //Generates homepage view
    public function showIndex()
    {

        $apartaments = Apartament::with(array('descriptions' => function($query){
                        $query->where('language_id', $this->language->id);
                        }))
                        ->get();

        //dd($apartaments);

    	return view('pages.index', ['apartaments' => $apartaments]);

    }


    //Generates view for single apartament
    public function showApartamentInfo($link) {

        //Find id of an apartment with $link passed to controller
        $linktoid = DB::table('apartament_descriptions')
                    ->select('apartament_id')
                    ->where('apartament_link',$link)
                    ->get();


        $id = $linktoid[0]->apartament_id;


        $apartament = Apartament::with(array('descriptions' => function($query)
                {
                    $query->where('language_id', $this->language->id);
                }))->find($id);
    

        $apartamentGroup = DB::table('apartaments')->select('group_id')->where('id',$id)->pluck('group_id');

        //Generates similiar apartments, that are into the same group like mother-apartment.
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

    //Apartments search engine
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
                ->where(function($query) use ($region){
                    $query->where('apartaments.apartament_address',$region)
                          ->orWhere('apartaments.apartament_city',$region);
                })


                ->where(function($query) use ($arriveDate,$returnDate) {
                    $query->where(function($query) {
                        $query->WhereNull('reservation_arrive_date')
                              ->WhereNull('reservation_departure_date');

                        })
                            ->orWhere(function($query) use($arriveDate,$returnDate){
                                        $query->whereRaw('? not between reservation_arrive_date and reservation_departure_date AND ? not between reservation_arrive_date and reservation_departure_date',[$arriveDate,$returnDate]);

                            });


                })
               ->get(); 

        $counted = count($finds);
        //dd($finds);

       //dd(DB::getQueryLog());

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

        //Checks abailabity for each apartment in date (AJAX + JS)
        $availabity = DB::Table('apartaments')
                        ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')

                        ->where(function($query) use($id) {
                            $query->WhereNull('reservation_arrive_date')
                                  ->WhereNull('reservation_departure_date')
                                  ->Where('apartaments.id','=',$id);
                        })
                        ->orWhere(function($query) use($przyjazd,$powrot,$id){
                            $query->whereRaw('apartaments.id = ? AND ( ? not between reservation_arrive_date and reservation_departure_date AND ? not between reservation_arrive_date and reservation_departure_date)',[$id,$przyjazd,$powrot]);
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


    public function apartamentAutoComplete(Request $request)
    {

        $przyjazd = $request->input('phrase');



        $apartaments = DB::table('apartaments')->select('apartament_descriptions.apartament_name','apartaments.apartament_address')
                    ->join('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
                    ->join('languages', function($join) {
                        $join->on('apartament_descriptions.language_id','=','languages.id')
                            ->where('languages.id', $this->language->id);
                    })
                    ->where('apartament_name','like','%'.$przyjazd.'%')
                    ->get();

        //dd($apartaments);
        return response(json_encode($apartaments));
    }
}
