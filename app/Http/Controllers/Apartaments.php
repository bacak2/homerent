<?php
/**
 *@category Kontroler apartamentów, aplikacji HOMEENT
 *@author Arkadiusz Adamczyk
 *@version 1.0
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\{Apartament, Apartament_description, Apartament_group, Reservation};
use Illuminate\Pagination\Paginator;
use DateTime;
use Auth;
use Illuminate\Support\Facades\Session;

class Apartaments extends Controller
{
    //Site language from database
    protected $language = 1;

    public function __construct()
    {
        $temp = \App::getLocale();
        $language = DB::table('languages')->select('id')->where('language_code',$temp)->first();
        $this->language = $language;
        if ($this->language->id == 1) setlocale(LC_TIME, "pl_PL");
        else setlocale(LC_TIME, "en_EN");
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

        //umieszczenie w cookie ostatnio oglądanych apartamentów
        if(isset($_COOKIE['lastSeenApartments'])) $lastSeenApartments = unserialize($_COOKIE['lastSeenApartments']);
        else $lastSeenApartments = [];

        if(!(in_array($id, $lastSeenApartments))) {

            array_unshift($lastSeenApartments, $id);
            if(count($lastSeenApartments) > 4){
                array_pop($lastSeenApartments);
            }

        }

        setcookie('lastSeenApartments', serialize($lastSeenApartments), time() + (86400 * 30), '/');

        // Generates calendar
        $calendar = Apartament::generateCalendar($id);

        if(isset($_COOKIE['lastSeenApartments'])) $cookiesApartments = unserialize($_COOKIE['lastSeenApartments']);
        else $cookiesApartments = [];

        $lastSeen = Apartament::selectRaw('*, apartaments.id, MIN(price_value) AS min_price')
            ->join('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
            ->join('languages', function($join) {
                $join->on('apartament_descriptions.language_id','=','languages.id')
                    ->where('languages.id', $this->language->id);
            })
            ->leftJoin('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
            ->whereIn('apartaments.id', $cookiesApartments)
            ->groupBy('apartaments.id')
            ->limit(4)
            ->get();

        $countedCookies = $lastSeen->count();

    //////rules to change!!!
        $seeAlso = Apartament::selectRaw('*, apartaments.id, MIN(price_value) AS min_price')
            ->join('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
            ->join('languages', function($join) {
                $join->on('apartament_descriptions.language_id','=','languages.id')
                    ->where('languages.id', $this->language->id);
            })
            ->leftJoin('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
            ->groupBy('apartaments.id')
            ->limit(4)
            ->get();

        $favouritesAmount = DB::table('apartament_favourites')->where('user_id', Auth::user()->id ?? 0)->get();
        if($favouritesAmount->isEmpty()) $favouritesAmount = 0;
        else $favouritesAmount = 1;

        $comments = DB::table('apartament_opinions')->where('id_apartament', $id)->get();

        if($comments->isEmpty()) $comments = '';
        else {
            $comments = json_encode($comments);

            $familyComments = DB::table('apartament_opinions')->where('id_apartament', $id)->where('journey_type', 0)->get();
            $familyComments = json_encode($familyComments);

            $couplesComments = DB::table('apartament_opinions')->where('id_apartament', $id)->where('journey_type', 1)->get();
            $couplesComments = json_encode($couplesComments);

            $businessComments = DB::table('apartament_opinions')->where('id_apartament', $id)->where('journey_type', 2)->get();
            $businessComments = json_encode($businessComments);

            $friendsComments = DB::table('apartament_opinions')->where('id_apartament', $id)->where('journey_type', 3)->get();
            $friendsComments = json_encode($friendsComments);

            $aloneComments = DB::table('apartament_opinions')->where('id_apartament', $id)->where('journey_type', 4)->get();
            $aloneComments = json_encode($aloneComments);

            $allOpinions = DB::table('apartament_opinions')
                ->selectRaw('
                        count(*) as opinionsAmount,
                        round(avg(total_rating), 1) as totalAvg,
                        round(avg(cleanliness), 1) as cleanlinessAvg,
                        round(avg(location), 1) as locationAvg,
                        round(avg(facilities), 1) as facilitiesAvg,
                        round(avg(staff), 1) staffAvg,
                        round(avg(quality_per_price), 1) quality_per_priceAvg
                        ')
                ->where('id_apartament', $id)
                ->first();
            $allOpinions = json_encode($allOpinions);

            $familyOpinions = DB::table('apartament_opinions')
                ->selectRaw('
                        count(*) as opinionsAmount,
                        round(avg(total_rating), 1) as totalAvg,
                        round(avg(cleanliness), 1) as cleanlinessAvg,
                        round(avg(location), 1) as locationAvg,
                        round(avg(facilities), 1) as facilitiesAvg,
                        round(avg(staff), 1) staffAvg,
                        round(avg(quality_per_price), 1) quality_per_priceAvg
                        ')
                ->where('id_apartament', $id)
                ->where('journey_type', 0)
                ->first();
            $familyOpinions = json_encode($familyOpinions);

            $couplesOpinions = DB::table('apartament_opinions')
                ->selectRaw('
                        count(*) as opinionsAmount,
                        round(avg(total_rating), 1) as totalAvg,
                        round(avg(cleanliness), 1) as cleanlinessAvg,
                        round(avg(location), 1) as locationAvg,
                        round(avg(facilities), 1) as facilitiesAvg,
                        round(avg(staff), 1) staffAvg,
                        round(avg(quality_per_price), 1) quality_per_priceAvg
                        ')
                ->where('id_apartament', $id)
                ->where('journey_type', 1)
                ->first();
            $couplesOpinions = json_encode($couplesOpinions);

            $businessOpinions = DB::table('apartament_opinions')
                ->selectRaw('
                        count(*) as opinionsAmount,
                        round(avg(total_rating), 1) as totalAvg,
                        round(avg(cleanliness), 1) as cleanlinessAvg,
                        round(avg(location), 1) as locationAvg,
                        round(avg(facilities), 1) as facilitiesAvg,
                        round(avg(staff), 1) staffAvg,
                        round(avg(quality_per_price), 1) quality_per_priceAvg
                        ')
                ->where('id_apartament', $id)
                ->where('journey_type', 2)
                ->first();
            $businessOpinions = json_encode($businessOpinions);

            $friendsOpinions = DB::table('apartament_opinions')
                ->selectRaw('
                        count(*) as opinionsAmount,
                        round(avg(total_rating), 1) as totalAvg,
                        round(avg(cleanliness), 1) as cleanlinessAvg,
                        round(avg(location), 1) as locationAvg,
                        round(avg(facilities), 1) as facilitiesAvg,
                        round(avg(staff), 1) staffAvg,
                        round(avg(quality_per_price), 1) quality_per_priceAvg
                        ')
                ->where('id_apartament', $id)
                ->where('journey_type', 3)
                ->first();
            $friendsOpinions = json_encode($friendsOpinions);

            $aloneOpinions = DB::table('apartament_opinions')
                ->selectRaw('
                        count(*) as opinionsAmount,
                        round(avg(total_rating), 1) as totalAvg,
                        round(avg(cleanliness), 1) as cleanlinessAvg,
                        round(avg(location), 1) as locationAvg,
                        round(avg(facilities), 1) as facilitiesAvg,
                        round(avg(staff), 1) staffAvg,
                        round(avg(quality_per_price), 1) quality_per_priceAvg
                        ')
                ->where('id_apartament', $id)
                ->where('journey_type', 4)
                ->first();
            $aloneOpinions = json_encode($aloneOpinions);

            $fourStars = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('total_rating', '<', 8)
                ->where('total_rating', '>=', 6);

            $threeStars = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('total_rating', '<', 6)
                ->where('total_rating', '>=', 4);

            $twoStars = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('total_rating', '<', 4)
                ->where('total_rating', '>=', 2);

            $oneStar = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('total_rating', '<', 2);

            $allStars = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('total_rating', '>=', 8)
                ->unionAll($fourStars)
                ->unionAll($threeStars)
                ->unionAll($twoStars)
                ->unionAll($oneStar)
                ->get();

            $allStars = json_encode($allStars);

            $journeyType = 0;
            $fourStars = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '<', 8)
                ->where('total_rating', '>=', 6);

            $threeStars = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '<', 6)
                ->where('total_rating', '>=', 4);

            $twoStars = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '<', 4)
                ->where('total_rating', '>=', 2);

            $oneStar = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '<', 2);

            $familyStars = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '>=', 8)
                ->unionAll($fourStars)
                ->unionAll($threeStars)
                ->unionAll($twoStars)
                ->unionAll($oneStar)
                ->get();

            $familyStars = json_encode($familyStars);

            $journeyType = 1;

            $fourStars = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '<', 8)
                ->where('total_rating', '>=', 6);

            $threeStars = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '<', 6)
                ->where('total_rating', '>=', 4);

            $twoStars = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '<', 4)
                ->where('total_rating', '>=', 2);

            $oneStar = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '<', 2);

            $couplesStars = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '>=', 8)
                ->unionAll($fourStars)
                ->unionAll($threeStars)
                ->unionAll($twoStars)
                ->unionAll($oneStar)
                ->get();

            $couplesStars = json_encode($couplesStars);

            $journeyType = 2;
            $fourStars = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '<', 8)
                ->where('total_rating', '>=', 6);

            $threeStars = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '<', 6)
                ->where('total_rating', '>=', 4);

            $twoStars = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '<', 4)
                ->where('total_rating', '>=', 2);

            $oneStar = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '<', 2);

            $businessStars = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '>=', 8)
                ->unionAll($fourStars)
                ->unionAll($threeStars)
                ->unionAll($twoStars)
                ->unionAll($oneStar)
                ->get();

            $businessStars = json_encode($businessStars);

            $journeyType = 3;
            $fourStars = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '<', 8)
                ->where('total_rating', '>=', 6);

            $threeStars = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '<', 6)
                ->where('total_rating', '>=', 4);

            $twoStars = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '<', 4)
                ->where('total_rating', '>=', 2);

            $oneStar = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '<', 2);

            $friendsStars = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '>=', 8)
                ->unionAll($fourStars)
                ->unionAll($threeStars)
                ->unionAll($twoStars)
                ->unionAll($oneStar)
                ->get();

            $friendsStars = json_encode($friendsStars);

            $journeyType = 4;

            $fourStars = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '<', 8)
                ->where('total_rating', '>=', 6);

            $threeStars = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '<', 6)
                ->where('total_rating', '>=', 4);

            $twoStars = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '<', 4)
                ->where('total_rating', '>=', 2);

            $oneStar = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '<', 2);

            $aloneStars = DB::table('apartament_opinions')
                ->selectRaw('count(*) as amount')
                ->where('id_apartament', $id)
                ->where('journey_type', $journeyType)
                ->where('total_rating', '>=', 8)
                ->unionAll($fourStars)
                ->unionAll($threeStars)
                ->unionAll($twoStars)
                ->unionAll($oneStar)
                ->get();

            $aloneStars = json_encode($aloneStars);
        }

        $isInFavourites = DB::table('apartament_favourites')
            ->where('apartament_id', '=', $id)
            ->where('user_id', '=', Auth::user()->id ?? 0)
            ->first();

        $isInFavourites = $isInFavourites->id ?? 0;

        return view('pages.apartaments', ['apartament' => $apartament,
            'groups' => $groups,
            'images' => $images,
            'priceFrom' => $priceFrom,
            'beds' => $beds,
            'calendar' => $calendar,
            'language' => $this->language,
            'lastSeen' => $lastSeen,
            'countedCookies' => $countedCookies,
            'seeAlso' => $seeAlso,
            'comments' => $comments,
            'familyComments' => $familyComments ?? 0,
            'couplesComments' => $couplesComments ?? 0,
            'businessComments' => $businessComments ?? 0,
            'friendsComments' => $friendsComments ?? 0,
            'aloneComments' => $aloneComments ?? 0,
            'allOpinions' => $allOpinions ?? 0,
            'familyOpinions' => $familyOpinions ?? 0,
            'couplesOpinions' => $couplesOpinions ?? 0,
            'businessOpinions' => $businessOpinions ?? 0,
            'friendsOpinions' => $friendsOpinions ?? 0,
            'aloneOpinions' => $aloneOpinions ?? 0,
            'allStars' => $allStars ?? 0,
            'familyStars' => $familyStars ?? 0,
            'couplesStars' => $couplesStars ?? 0,
            'businessStars' => $businessStars ?? 0,
            'friendsStars' => $friendsStars ?? 0,
            'aloneStars' => $aloneStars ?? 0,
            'isInFavourites' => $isInFavourites,
            'favouritesAmount' => $favouritesAmount,
        ]);

    }

    //Generates view for group of apartments
    public function showApartamentGroup($link) {

        //Find id of an apartment with $link passed to controller
        $linktoid = DB::table('apartament_groups')
            ->select('group_id')
            ->where('group_link',$link)
            ->get();

        $id = $linktoid[0]->group_id;

        $groupDescription = DB::table('apartament_groups')
            ->select('*')
            ->join('apartament_group_descriptions','apartament_groups.group_id','=','apartament_group_descriptions.apartament_id')
            ->where('apartament_id',$id)
            ->where('language_id', $this->language->id)
            ->get();

        //Generates an array of images gallery
        $images = DB::table('apartaments')
            ->select('apartament_photos.photo_link','apartaments.id')
            ->join('apartament_photos','apartaments.id','=','apartament_photos.apartament_id')
            ->where('apartament_id', $id)
            ->get();

        $priceFrom = $this->getPriceFrom($id);

        //suma wszystkich łóżek
        $beds = $groupDescription[0]->apartament_single_beds+$groupDescription[0]->apartament_double_beds;

        $apartaments = DB::table("apartaments")->selectRaw('*, apartaments.id, MIN(price_value) AS min_price')
            ->leftJoin('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
            ->leftJoin('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
            ->leftJoin('languages','apartament_descriptions.language_id', '=', 'languages.id')
            ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
            ->where('apartaments.group_id', $id)
            ->where('language_id', $this->language->id)
            ->groupBy('apartaments.id')
            ->paginate(12);

        $apartamentsAmount = $apartaments->count();

        $idApartments = array();
        foreach($apartaments as $apartament){
            array_push($idApartments, $apartament->id);
        }

        if(isset($_COOKIE['lastSeenApartments'])) $cookiesApartments = unserialize($_COOKIE['lastSeenApartments']);
        else $cookiesApartments = [];

        $lastSeen = Apartament::selectRaw('*, apartaments.id, MIN(price_value) AS min_price')
            ->join('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
            ->join('languages', function($join) {
                $join->on('apartament_descriptions.language_id','=','languages.id')
                    ->where('languages.id', $this->language->id);
            })
            ->leftJoin('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
            ->whereIn('apartaments.id', $cookiesApartments)
            ->groupBy('apartaments.id')
            ->limit(4)
            ->get();

        $countedCookies = $lastSeen->count();

        //////rules to change!!!
        $seeAlso = Apartament::selectRaw('*, apartaments.id, MIN(price_value) AS min_price')
            ->join('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
            ->join('languages', function($join) {
                $join->on('apartament_descriptions.language_id','=','languages.id')
                    ->where('languages.id', $this->language->id);
            })
            ->leftJoin('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
            ->groupBy('apartaments.id')
            ->limit(4)
            ->get();

        return view('pages.apartamentsGroup', [
            'apartaments' => $apartaments,
            'idApartments' => $idApartments,
            'groupDescription' => $groupDescription,
            'images' => $images,
            'priceFrom' => $priceFrom,
            'beds' => $beds,
            'language' => $this->language,
            'apartamentsAmount' => $apartamentsAmount,
            'lastSeen' => $lastSeen,
            'countedCookies' => $countedCookies,
            'seeAlso' => $seeAlso,
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
    public function searchApartaments(Request $request, $view) {
        $request->amount = $request->Mamount ?? $request->amount;
        $request->amount2 = $request->Mamount2 ?? $request->amount2;
        if($request->amount == "1000+") $request->amount = 10000;
        if($request->amount2 == "1000+") $request->amount2 = 10000;
        $region = $request->input('region');

        //Date Parsing
        $arriveToChange = explode(' ', $request->input('przyjazd'));
        $arriveToChange = str_replace('.', '-', $arriveToChange[1]);
        $departureToChange = explode(' ', $request->input('powrot'));
        $departureToChange = str_replace('.', '-', $departureToChange[1]);

        $arriveDate = date("Y-m-d", strtotime($arriveToChange));
        $returnDate = date("Y-m-d", strtotime($departureToChange));
        $dprz = strtotime($arriveDate);
        $dpwr = strtotime($returnDate);
        $nightsCounter = ($dpwr - $dprz)/(60 * 60 * 24);

        switch($view) {
            case 'kafle':
                $paginate = 16;
                break;
            case 'lista':
                $paginate = 8;
                break;
            case 'mapa':
                $paginate = 100;
                break;
            default:
                $paginate = 16;
                break;
        }

        $whereData = [];
        if ($request->has('spa')) array_push($whereData, ['apartaments.apartament_spa', '1']);
        if ($request->has('garaz')) array_push($whereData, ['apartaments.apartament_parking', '1']);
        if ($request->has('kominek')) array_push($whereData, ['apartaments.apartament_fireplace', '1']);
        if ($request->has('balkon')) array_push($whereData, ['apartaments.apartament_balcony', '1']);
        if ($request->has('zwierzeta')) array_push($whereData, ['apartaments.apartament_animals', '1']);

        $withoutGroup = DB::table("apartaments")
            ->selectRaw('lastReservation.lastReservationDate, sub.opinionAmount, sub.ratingAvg, apartaments.*, apartament_descriptions.*, apartaments.id, MIN(price_value) AS min_price')
            ->leftJoin('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
            ->leftJoin('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
            ->leftJoin('apartament_groups','apartaments.group_id', '=', 'apartament_groups.group_id')
            ->leftJoin('languages','apartament_descriptions.language_id', '=', 'languages.id')
            ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
            ->leftjoin(DB::raw('(select id_apartament, count(id_apartament) as opinionAmount, avg(total_rating) as ratingAvg from `reservations`
                cross join `apartament_opinions` on `reservations`.`id` = `apartament_opinions`.`id_reservation`  group by id_apartament) sub
            '), 'sub.id_apartament', '=', 'apartaments.id')
            ->leftjoin(DB::raw('(select apartament_id, reservations.created_at as lastReservationDate from `apartaments`
                right join `reservations` on `apartaments`.`id` = `reservations`.`id`  group by apartament_id) lastReservation
            '), 'lastReservation.apartament_id', '=', 'apartaments.id')
            ->whereNotIn('apartaments.id', Apartament::select('apartaments.id')
            ->join('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
            /*->leftJoin('apartament_prices', function($join) {
                $join->on('apartament_prices.apartament_id','=','apartaments.id')
                    ->where('price_value', DB::raw("(select min(`price_value`) from apartament_prices where apartament_id = 1)"));
            })
            */
            ->leftJoin('languages', function($join) {
                $join->on('apartament_descriptions.language_id','=','languages.id');
            })

            ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
            ->where(function($query) use ($region){
                if($region == NULL){
                    //
                }
                else{
                    $query->where('apartament_descriptions.apartament_name',$region)
                        ->orWhere('apartaments.apartament_city',$region);
                }
            })
            ->where(function($query) use ($arriveDate,$returnDate) {
                $query->whereRaw('((reservation_arrive_date + INTERVAL 1 DAY between ? and ?) or (reservation_departure_date - INTERVAL 1 DAY between ? and ?))',[$arriveDate, $returnDate, $arriveDate, $returnDate]);
                //$query->whereRaw('(? between reservation_arrive_date and reservation_departure_date) OR (? between reservation_arrive_date and reservation_departure_date)',[$arriveDate,$returnDate]);
            })
            ->where(function($query) use ($request){
                if ($request->has('1room')) $query->where('apartament_rooms_number', '1');
                if ($request->has('2rooms')) $query->orWhere('apartament_rooms_number', '2');
                if ($request->has('3rooms')) $query->orWhere('apartament_rooms_number', '3');
                if ($request->has('4rooms')) $query->orWhere('apartament_rooms_number', '>', '3');
            })
            ->where(function($query) use ($request){
                $query->where(function($query) use ($request){
                    if ($request->has('doubleBed'))$query->where('apartament_double_beds', '>', '0');
                })
                    ->where(function($query) use ($request){
                        if ($request->has('1bed')) $query->orwhere('apartament_single_beds', '1');
                        if ($request->has('2beds')) $query->orWhere('apartament_single_beds', '2');
                        if ($request->has('3beds')) $query->orWhere('apartament_single_beds', '>', '2');
                    });
            })
            ->distinct('apartaments.id'))
            ->where('language_id', $this->language->id)
            ->whereBetween('price_value', array($request->amount ?? 0, $request->amount2 ?? 10000))
            ->whereBetween('date_of_price', array($arriveDate, $returnDate))
            ->where($whereData)
            /*->where(function($query) use ($request) {
                if($request->amount2 == "+1000") $query->where('price_value', '>', $request->amount);
                else $query->whereBetween('price_value', array($request->amount, $request->amount2));
            })
            */
            ->where(function($query) use ($region){
                if($region == NULL){
                    //
                }
                else{
                    $query->where('apartament_descriptions.apartament_name',$region)
                        ->orWhere('apartaments.apartament_city',$region);
                }
            })
            //->where('apartaments.group_id', 0)
            ->groupBy('apartaments.id');
            //->groupBy('apartaments.group_id')
            //->orderBy('apartaments.group_id', 'DESC')
            //->paginate($paginate, ['apartaments.id']);

        $finds = DB::table("apartaments")
            ->selectRaw('lastReservation.lastReservationDate, sub.opinionAmount, sub.ratingAvg, apartament_groups.*, apartament_descriptions.*, apartaments.id, MIN(price_value) AS min_price')
            ->leftJoin('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
            ->leftJoin('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
            ->leftJoin('apartament_groups','apartaments.group_id', '=', 'apartament_groups.group_id')
            ->leftJoin('languages','apartament_descriptions.language_id', '=', 'languages.id')
            ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
            ->leftjoin(DB::raw('(select id_apartament, count(id_apartament) as opinionAmount, avg(total_rating) as ratingAvg from `reservations`
                cross join `apartament_opinions` on `reservations`.`id` = `apartament_opinions`.`id_reservation`  group by id_apartament) sub
            '), 'sub.id_apartament', '=', 'apartaments.id')
            ->leftjoin(DB::raw('(select apartament_id, reservations.created_at as lastReservationDate from `apartaments`
                right join `reservations` on `apartaments`.`id` = `reservations`.`id`  group by apartament_id) lastReservation
            '), 'lastReservation.apartament_id', '=', 'apartaments.id')
            ->whereNotIn('apartaments.id', Apartament::select('apartaments.id')
                ->join('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
                /*->leftJoin('apartament_prices', function($join) {
                    $join->on('apartament_prices.apartament_id','=','apartaments.id')
                        ->where('price_value', DB::raw("(select min(`price_value`) from apartament_prices where apartament_id = 1)"));
                })
                */
                ->leftJoin('languages', function($join) {
                    $join->on('apartament_descriptions.language_id','=','languages.id');
                })

                ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
                ->where(function($query) use ($region){
                    if($region == NULL){
                        //
                    }
                    else{
                        $query->where('apartament_descriptions.apartament_name',$region)
                            ->orWhere('apartaments.apartament_city',$region);
                    }
                })
                ->where(function($query) use ($arriveDate,$returnDate) {
                    $query->whereRaw('((reservation_arrive_date + INTERVAL 1 DAY between ? and ?) or (reservation_departure_date - INTERVAL 1 DAY between ? and ?))',[$arriveDate, $returnDate, $arriveDate, $returnDate]);
                    //$query->whereRaw('(? between reservation_arrive_date and reservation_departure_date) OR (? between reservation_arrive_date and reservation_departure_date)',[$arriveDate,$returnDate]);
                })
                ->where(function($query) use ($request){
                    if ($request->has('1room')) $query->where('apartament_rooms_number', '1');
                    if ($request->has('2rooms')) $query->orWhere('apartament_rooms_number', '2');
                    if ($request->has('3rooms')) $query->orWhere('apartament_rooms_number', '3');
                    if ($request->has('4rooms')) $query->orWhere('apartament_rooms_number', '>', '3');
                })
                ->where(function($query) use ($request){
                    $query->where(function($query) use ($request){
                        if ($request->has('doubleBed'))$query->where('apartament_double_beds', '>', '0');
                    })
                        ->where(function($query) use ($request){
                            if ($request->has('1bed')) $query->orwhere('apartament_single_beds', '1');
                            if ($request->has('2beds')) $query->orWhere('apartament_single_beds', '2');
                            if ($request->has('3beds')) $query->orWhere('apartament_single_beds', '>', '2');
                        });
                })
                ->distinct('apartaments.id'))
            ->where('language_id', $this->language->id)
            ->whereBetween('price_value', array($request->amount ?? 0, $request->amount2 ?? 10000))
            ->whereBetween('date_of_price', array($arriveDate, $returnDate))
            ->where($whereData)
            /*->where(function($query) use ($request) {
                if($request->amount2 == "+1000") $query->where('price_value', '>', $request->amount);
                else $query->whereBetween('price_value', array($request->amount, $request->amount2));
            })
            */
            ->where(function($query) use ($region){
                if($region == NULL){
                    //
                }
                else{
                    $query->where('apartament_descriptions.apartament_name',$region)
                        ->orWhere('apartaments.apartament_city',$region);
                }
            })
            ->where('apartaments.group_id', '>', 0)
            //->groupBy('apartaments.id')
            ->groupBy('apartaments.group_id')
            ->orderBy('apartaments.group_id', 'DESC')
            ->unionAll($withoutGroup)
            ->get();

            //->paginate($paginate, ['apartaments.id']);

        if($view == 'mapa'){
            $idFinds = array();
            foreach($finds as $find){
                array_push($idFinds, $find->id);
            }
        }

        $countedObjects = 0;
        $countedApartaments = 0;
        foreach($finds as $find){
            if($find->group_name != NULL && $find->group_id > 0) $countedObjects++;
            else if($find->group_id == 0){
                $countedApartaments++;
                $countedObjects++;
            }
            else $countedApartaments++;
        }

        $finds = $finds->all();
        $finds = new Paginator($finds, $paginate);

        $black = 0;
        $gray = 0;

        if($view == 'mapa'){

            $black = DB::table("apartaments")
                ->selectRaw('apartaments.*, apartament_descriptions.*, apartaments.id, MIN(price_value) AS min_price')
                ->leftJoin('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
                ->leftJoin('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
                ->leftJoin('apartament_groups','apartaments.group_id', '=', 'apartament_groups.group_id')
                ->leftJoin('languages','apartament_descriptions.language_id', '=', 'languages.id')
                ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
                ->whereNotIn('apartaments.id', Apartament::select('apartaments.id')
                    ->join('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
                    ->leftJoin('languages', function($join) {
                        $join->on('apartament_descriptions.language_id','=','languages.id');
                    })

                    ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
                    ->where(function($query) use ($region){
                        if($region == NULL){
                            //
                        }
                        else{
                            $query->where('apartament_descriptions.apartament_name',$region)
                                ->orWhere('apartaments.apartament_city',$region);
                        }
                    })
                    ->where(function($query) use ($arriveDate,$returnDate) {
                        $query->whereRaw('((reservation_arrive_date + INTERVAL 1 DAY between ? and ?) or (reservation_departure_date - INTERVAL 1 DAY between ? and ?))',[$arriveDate, $returnDate, $arriveDate, $returnDate]);
                        //$query->whereRaw('(? between reservation_arrive_date and reservation_departure_date) OR (? between reservation_arrive_date and reservation_departure_date)',[$arriveDate,$returnDate]);
                    })
                    ->where(function($query) use ($request){
                        if ($request->has('1room')) $query->where('apartament_rooms_number', '1');
                        if ($request->has('2rooms')) $query->orWhere('apartament_rooms_number', '2');
                        if ($request->has('3rooms')) $query->orWhere('apartament_rooms_number', '3');
                        if ($request->has('4rooms')) $query->orWhere('apartament_rooms_number', '>', '3');
                    })
                    ->where(function($query) use ($request){
                        $query->where(function($query) use ($request){
                            if ($request->has('doubleBed'))$query->where('apartament_double_beds', '>', '0');
                        })
                            ->where(function($query) use ($request){
                                if ($request->has('1bed')) $query->orwhere('apartament_single_beds', '1');
                                if ($request->has('2beds')) $query->orWhere('apartament_single_beds', '2');
                                if ($request->has('3beds')) $query->orWhere('apartament_single_beds', '>', '2');
                            });
                    })
                    ->distinct('apartaments.id'))
                ->where('language_id', $this->language->id)
                ->whereBetween('date_of_price', array($arriveDate, $returnDate))
                ->whereNotIn('apartaments.id', $idFinds)
                ->where(function($query) use ($region){
                    if($region == NULL){
                        //
                    }
                    else{
                        $query->where('apartament_descriptions.apartament_name',$region)
                            ->orWhere('apartaments.apartament_city',$region);
                    }
                })
                ->where('apartaments.group_id', 0)
                ->groupBy('apartaments.id')
                ->get();

            $blackIds = array();
            foreach($black as $blackId){
                array_push($blackIds, $blackId->id);
            }

            $blueAndBlackIds = array_merge($blackIds, $idFinds);

            //apartaments not available in this term
            $gray = DB::table("apartaments")
                ->selectRaw('apartaments.*, apartament_descriptions.*, apartaments.id, MIN(price_value) AS min_price')
                ->leftJoin('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
                ->leftJoin('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
                ->leftJoin('apartament_groups','apartaments.group_id', '=', 'apartament_groups.group_id')
                ->leftJoin('languages','apartament_descriptions.language_id', '=', 'languages.id')
                ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')

                ->where('language_id', $this->language->id)
                ->whereNotIn('apartaments.id', $blueAndBlackIds )
                ->where(function($query) use ($region){
                    if($region == NULL){
                        //
                    }
                    else{
                        $query->where('apartament_descriptions.apartament_name',$region)
                            ->orWhere('apartaments.apartament_city',$region);
                    }
                })
                ->where('apartaments.group_id', 0)
                ->groupBy('apartaments.id')
                ->get();

        }

        if ($countedObjects === 0) $view = ("none");

        if(isset($_COOKIE['lastSeenApartments'])) $cookiesApartments = unserialize($_COOKIE['lastSeenApartments']);
        else $cookiesApartments = [];

        $lastSeen = Apartament::selectRaw('*, apartaments.id, MIN(price_value) AS min_price')
            ->join('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
            ->join('languages', function($join) {
                $join->on('apartament_descriptions.language_id','=','languages.id')
                    ->where('languages.id', $this->language->id);
            })
            ->leftJoin('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
            ->whereIn('apartaments.id', $cookiesApartments)
            ->groupBy('apartaments.id')
            ->limit(4)
            ->get();

        $countedCookies = $lastSeen->count();

        $favouritesAmount = DB::table('apartament_favourites')->where('user_id', Auth::user()->id ?? 0)->get();
        if($favouritesAmount->isEmpty()) $favouritesAmount = 0;
        else $favouritesAmount = 1;

        return view("pages.results-".$view, [
            'region' => $region,
            'arive_date' => $arriveDate,
            'return_date' => $returnDate,
            'finds' => $finds,
            'countedObjects' => $countedObjects,
            'countedApartaments' => $countedApartaments,
            'request' => $request,
            'black' => $black,
            'gray' => $gray,
            'nightsCounter' => $nightsCounter,
            'lastSeen' => $lastSeen,
            'countedCookies' => $countedCookies,
            'favouritesAmount' => $favouritesAmount,
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
            ->where('apartaments.id','=',$id)
            ->whereNotIn('apartaments.id', function($query) use($przyjazd,$powrot){
                $query->select('apartaments.id')
                    ->from('apartaments')
                    ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
                    ->whereRaw('((reservation_arrive_date + INTERVAL 1 DAY between ? and ?) or (reservation_departure_date - INTERVAL 1 DAY between ? and ?))',[$przyjazd, $powrot, $przyjazd, $powrot]);
            })

            ->get();

        $totalPrice = DB::Table('apartament_prices')
            ->selectRaw('sum(price_value) AS total_price')
            ->where('apartament_id',$id)
            ->where('date_of_price','>=',$przyjazd)
            ->where('date_of_price','<',$powrot)
            ->get();

        $is_available= TRUE;

        if(count($availabity) > 0) {
            $is_available = TRUE;
        }
        else  {
            $is_available = FALSE;

            $checkFreeDate = DB::table('reservations')
                ->selectRaw("DATE_ADD(reservations.reservation_departure_date, INTERVAL 1 DAY) as arrival")
                ->whereDate('reservations.reservation_departure_date', '>', $przyjazd)
                ->where('apartament_id', $id)
                ->orderBy('reservations.reservation_departure_date')
                ->get();

            foreach($checkFreeDate as $checkDate){
                $arrival = $checkDate->arrival;
                $departure = new DateTime("$arrival");
                $departure = $departure->modify("+$nightsCounter days")->format('Y-m-d');

                $firstFreeAvailability = DB::Table('apartaments')
                    ->selectRaw("reservations.reservation_arrive_date as arrival,
                             reservations.reservation_departure_date as departure
                            ")
                    ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
                    ->where('apartaments.id','=', 1)
                    ->whereNotIn('apartaments.id', function($query) use($arrival, $departure){
                        $query->select('apartaments.id')
                            ->from('apartaments')
                            ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
                            ->whereRaw('((reservation_arrive_date + INTERVAL 1 DAY between ? and ?) or (reservation_departure_date - INTERVAL 1 DAY between ? and ?))',[$arrival, $departure, $arrival, $departure]);
                    })
                    ->first();

                if(count($firstFreeAvailability) > 0) {
                    $firstArrival = $arrival;
                    $firstDeparture = $departure;
                    break;
                }
            }
        }

        return response()->json([
            'days_number' => $nightsCounter,
            'price' => $totalPrice[0]->total_price,
            'is_available' => $is_available,
            'message' => $this->language->id,
            'checkFreeDate' => $checkFreeDate ?? 0,
            'firstFreeAvailability' => $firstFreeAvailability ?? 0,
            'firstArrival' => $firstArrival ?? 0,
            'firstDeparture' => $firstDeparture ?? 0,
        ]);
    }

    public function checkGroupAvailability(Request $request)
    {
        $przyjazd = $request->input('przyjazd');
        $powrot = $request->input('powrot');
        $dprz = strtotime($przyjazd);
        $dpwr = strtotime($powrot);
        $nightsCounter = ($dpwr - $dprz) / (60 * 60 * 24);

        $ids = $request->input('ids');
        $is_available = FALSE;

        foreach($ids as $currentId) {
            //Checks availabity for each apartment in date (AJAX + JS)
            $availabity = DB::Table('apartaments')
                ->leftJoin('reservations', 'apartaments.id', '=', 'reservations.apartament_id')
                ->leftJoin('apartament_descriptions', 'apartaments.id', '=', 'apartament_descriptions.apartament_id')
                ->where('apartaments.id', '=', $currentId)
                ->whereNotIn('apartaments.id', function ($query) use ($przyjazd, $powrot) {
                    $query->select('apartaments.id')
                        ->from('apartaments')
                        ->leftJoin('reservations', 'apartaments.id', '=', 'reservations.apartament_id')
                        ->whereRaw('((reservation_arrive_date + INTERVAL 1 DAY between ? and ?) or (reservation_departure_date - INTERVAL 1 DAY between ? and ?))', [$przyjazd, $powrot, $przyjazd, $powrot]);
                })
                ->get();

            if (count($availabity) > 0) {
                $is_available = TRUE;
                $id = $currentId;
                $link = $availabity[0]->apartament_link;
                break;
            }
        }

        if ($is_available == TRUE) {
            $totalPrice = DB::Table('apartament_prices')
                ->selectRaw('sum(price_value) AS total_price')
                ->where('apartament_id', $id)
                ->where('date_of_price', '>=', $przyjazd)
                ->where('date_of_price', '<', $powrot)
                ->get();
            }

        else  {
            $is_available = FALSE;

            $checkFreeDate = DB::table('reservations')
                ->selectRaw("DATE_ADD(reservations.reservation_departure_date, INTERVAL 1 DAY) as arrival")
                ->whereDate('reservations.reservation_departure_date', '>', $przyjazd)
                ->where('apartament_id', $ids[0])
                ->orderBy('reservations.reservation_departure_date')
                ->get();

            $totalPrice = DB::Table('apartament_prices')
                ->selectRaw('sum(price_value) AS total_price')
                ->where('apartament_id', $ids[0])
                ->where('date_of_price', '>=', $przyjazd)
                ->where('date_of_price', '<', $powrot)
                ->get();

            foreach($checkFreeDate as $checkDate){
                $arrival = $checkDate->arrival;
                $departure = new DateTime("$arrival");
                $departure = $departure->modify("+$nightsCounter days")->format('Y-m-d');

                $firstFreeAvailability = DB::Table('apartaments')
                    ->selectRaw("reservations.reservation_arrive_date as arrival,
                             reservations.reservation_departure_date as departure
                            ")
                    ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
                    ->where('apartaments.id','=', 1)
                    ->whereNotIn('apartaments.id', function($query) use($arrival, $departure){
                        $query->select('apartaments.id')
                            ->from('apartaments')
                            ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
                            ->whereRaw('((reservation_arrive_date + INTERVAL 1 DAY between ? and ?) or (reservation_departure_date - INTERVAL 1 DAY between ? and ?))',[$arrival, $departure, $arrival, $departure]);
                    })
                    ->first();

                if(count($firstFreeAvailability) > 0) {
                    $firstArrival = $arrival;
                    $firstDeparture = $departure;
                    break;
                }
            }

        }

        return response()->json([
            'days_number' => $nightsCounter,
            'price' => $totalPrice[0]->total_price,
            'is_available' => $is_available,
            'message' => $this->language->id,
            'checkFreeDate' => $checkFreeDate ?? 0,
            'firstFreeAvailability' => $firstFreeAvailability ?? 0,
            'firstArrival' => $firstArrival ?? 0,
            'firstDeparture' => $firstDeparture ?? 0,
            'link' => $link ?? '',
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

    public function showApartamentsOnMap(Request $request){

        if ($request->niedostepne == 1){
            $finds = DB::Table('apartaments')
                ->get();
        }

        else if ($request->nieKryteria == 1){
            $finds = DB::Table('apartaments')
                ->where('apartament_city', '=', $request->region)
                ->get();
        }
        return response()->json($finds);

    }

    public function increaseHelpful(Request $request){

        $sessionId = Session::getId();

        if ($request->session()->exists("$request->opinionId/$sessionId")) {
            return response()->json("Już oceniłeś tą opinię");
        }

        DB::table('apartament_opinions')->where('id', $request->opinionId)->increment('helpful');

        session(["$request->opinionId/$sessionId" => 1]);

        return response()->json("Dodano ocenę do opinii");
    }
}
