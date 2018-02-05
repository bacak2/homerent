<?php
/**
 *@category Kontroler apartamentów, aplikacji HOMEENT
 *@author Arkadiusz Adamczyk
 *@version 1.0
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Apartament;
use App\Apartament_description;
use App\Apartament_group;
use App\Reservation;


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
        $todayDate = date("Y-m-d");
        //DB::connection()->enableQueryLog();
        //dd(DB::getQueryLog());
        $apartaments = DB::table('apartaments')
                        ->selectRaw('distinct(apartaments.id), apartament_descriptions.apartament_name, 
                          apartament_descriptions.apartament_link, apartament_photos.photo_link, MIN(apartament_prices.price_value) AS price_value')
                        ->join('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
                        ->join('languages', function($join) {
                            $join->on('apartament_descriptions.language_id','=','languages.id')
                                 ->where('languages.id', $this->language->id);
                            })
                        ->join('apartament_prices', function($join) use($todayDate) {
                            $join->on('apartament_prices.apartament_id','=','apartaments.id')

                            ->Where('apartament_prices.date_of_price','>=',$todayDate);

                        })
                        ->join('apartament_photos','apartaments.apartament_default_photo_id', '=', 'apartament_photos.id')
                        ->groupBy('apartaments.id','apartament_descriptions.id','apartament_descriptions.apartament_name','apartament_descriptions.apartament_link','apartament_photos.photo_link')
                        ->get();

        
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
    

        $apartamentGroup = DB::table('apartaments')
                    ->select('group_id')
                    ->where('id',$id)
                    ->pluck('group_id');

        //Generates an array of images gallery
        $images = DB::table('apartaments')
                    ->select('apartament_photos.photo_link','apartaments.id')
                    ->join('apartament_photos','apartaments.id','=','apartament_photos.apartament_id')
                    ->where('apartament_id',$id)
                    ->get();

        $priceFrom = $this->getPriceFrom($id);

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

        //suma wszystkich łóżek      
        $beds = $apartament->apartament_single_beds+$apartament->apartament_double_beds;
       // dd($groups); 
       // dd($descriptions);
       return view('pages.apartaments', ['apartament' => $apartament,
                                         'groups' => $groups,
                                         'images' => $images,
                                         'priceFrom' => $priceFrom,
                                         'beds' => $beds
                                        ]);

    }

    //Gets min apartament price
    public function getPriceFrom($id) {
        $todayDate = date("Y-m-d");
        $priceFrom = DB::table('apartament_prices')
                    ->select('price_value')
                    ->where('apartament_id',$id)
                    ->where('date_of_price','>=',$todayDate)
                    ->min('price_value');


        return $priceFrom;
    }

    //Apartments search engine
    public function searchApartaments(Request $request) {
        
        $region = $request->input('region');
        
        $aDate = $request->input('przyjazd');
        $rDate = $request->input('powrot');
        //Date Parsing
        $arriveDate = date("d-m-Y", strtotime($aDate));
        $returnDate = date("d-m-Y", strtotime($rDate));

        $finds = DB::Table('apartaments')//->select('apartaments.id')//->get();
                ->join('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
                ->join('languages', function($join) {
                        $join->on('apartament_descriptions.language_id','=','languages.id')
                            ->where('languages.id', $this->language->id);
                  })
                ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
                ->where(function($query) use ($region){
                    $query->where('apartament_descriptions.apartament_name',$region)
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
                ->addSelect('*', 'apartaments.id')
                ->get();

        $counted = count($finds);

        //dd($finds);
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

        //Checks availabity for each apartment in date (AJAX + JS)
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

        $totalPrice = DB::Table('apartament_prices')
                        ->selectRaw('sum(price_value) AS total_price')
                        ->where('apartament_id',$id)
                        ->where('date_of_price','>=',$przyjazd)
                        ->where('date_of_price','<',$powrot)
                        ->get();

        $is_available= TRUE;

        if(count($availabity) == 1) {
            $is_available = TRUE;

        }   
        else  {
            $is_available = FALSE;

        }

        return response()->json([   'days_number' => $nightsCounter,
                                    'price' => $totalPrice[0]->total_price,
                                    'is_available' => $is_available,
                                    'message' => 'Test'
        ]);
    }

    //Ajax autoComplete, returns json
    public function apartamentAutoComplete(Request $request)
    {

        $phrase = $request->input('phrase');
        
        $apartaments = DB::table('apartaments')->select('apartament_descriptions.apartament_name','apartaments.apartament_city')
                    ->join('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
                    ->join('languages', function($join) {
                        $join->on('apartament_descriptions.language_id','=','languages.id')
                            ->where('languages.id', $this->language->id);
                    })
                    ->where('apartament_name','like','%'.$phrase.'%')->get();

        //dd($apartaments);
        return response(json_encode($apartaments));
    }
}
