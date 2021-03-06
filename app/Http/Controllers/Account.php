<?php
/**
 *@category Kontroler konta usera, aplikacji HOMERENT
 *@author Krzysztof Baca
 *@version 1.0
 */


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\{Apartament, Apartament_description, Apartament_group, Reservation, User};
use Auth;
use Mail;
use Illuminate\Pagination\Paginator;
use Session;
use App;

class Account extends Controller
{
    //Site language from database
    protected $language = 1;

    public function __construct()
    {
        $this->middleware('auth');
        $temp = \App::getLocale();
        $language = DB::table('languages')->select('id', 'language_code')->where('language_code',$temp)->first();
        $this->language = $language;
        if ($this->language->id == 1) setlocale(LC_TIME, "pl_PL.utf8");
        else setlocale(LC_TIME, "en_EN");
    }

    public function index()
    {
        $users_account = DB::table('users_account')->where('user_email', Auth::user()->email)->get();
        
        return view('account.data', [
            'users_account' => json_encode($users_account),
        ]);
    }

    public function refreshView()
    {
        $usersAccount = DB::table('users_account')->where('user_email', Auth::user()->email)->get();

        return response(json_encode($usersAccount));
    }
    
    public function save(Request $request)
    {
        if ($request->input('id') != 0){
            DB::table('users_account')
                ->where('id', $request->input('id'))
                ->where('user_email', $request->input('user_email'))
                ->update([
                    'label' => $request->input('label') ?? $request->input('name'),
                    'name' => $request->input('name'),
                    'surname' => $request->input('surname'),
                    'address' => $request->input('address'),
                    'postcode' => $request->input('postcode'),
                    'place' => $request->input('place'),
                    'name_invoice' => $request->input('name_invoice'),
                    'surname_invoice' => $request->input('surname_invoice'),
                    'address_invoice' => $request->input('address_invoice'),
                    'postcode_invoice' => $request->input('postcode_invoice'),
                    'place_invoice' => $request->input('place_invoice'),
                    'phone' => $request->input('phone'),
                    'email' => $request->input('email'),
                    'invoice' => $request->input('invoice'),
                ]);
        }

        else {
            $dataSet[] = [
                'label'  => $request->input('label') ?? $request->input('name'),
                'name'  => $request->input('name'),
                'surname' => $request->input('surname'),
                'address' => $request->input('address'),
                'postcode' => $request->input('postcode'),
                'place' => $request->input('place'),
                'phone' => $request->input('phone'),
                'name_invoice'  => $request->input('name_invoice'),
                'surname_invoice' => $request->input('surname_invoice'),
                'address_invoice' => $request->input('address_invoice'),
                'postcode_invoice' => $request->input('postcode_invoice'),
                'place_invoice' => $request->input('place_invoice'),
                'email' => $request->input('email'),
                'user_email' => $request->input('user_email'),
                'invoice' => $request->input('invoice'),
            ];

            DB::table('users_account')->insert($dataSet);
        }


        return response()->json([
            'res' => $request->input('id'),
        ]);
    }

    public function editItem($id){
        $userAccount = DB::table('users_account')->select('id', 'name', 'surname')->where('id', $id)->get();

        return response(json_encode($userAccount));
    }    
    
    public function deleteItem($id){
        DB::table('users_account')->where('id', $id)->delete();

        return response()->json([
            'res' => 'true',
        ]);
    }

    public function reservations(Request $request)
    {
        //dd($request);
        $request->flash();

        switch($request->sortBy){
            case 'reservation': $order = 'created_at'; $orderByFuture = 'DESC'; $orderByGone = 'DESC'; break;
            case 'arrive': default: $order = 'reservation_arrive_date'; $orderByFuture = 'ASC'; $orderByGone = 'DESC'; break;
        }

        $current_data = date("Y-m-d");

        $users_reservations_future = DB::table('reservations')
            ->select('reservations.*', 'apartaments.apartament_address', 'apartaments.apartament_address_2', 'apartaments.apartament_city', 'apartaments.apartament_district', 'apartament_descriptions.apartament_name', 'apartament_link')
            ->distinct('id')
            ->leftjoin('apartaments', 'reservations.apartament_id', '=', 'apartaments.id')
            ->leftjoin('apartament_descriptions', 'reservations.apartament_id', '=', 'apartament_descriptions.apartament_id')
            ->where('user_id', Auth::user()->id)
            ->where('reservation_arrive_date', '>=', $current_data)
            ->where(function($query) use ($request){
                if($request->searchReservation == NULL){
                    //
                }
                else{
                    $query->where('apartaments.apartament_address', 'like', '%'.$request->searchReservation.'%')
                        ->orWhere('apartaments.apartament_city', 'like', '%'.$request->searchReservation.'%')
                        ->orWhere('apartaments.apartament_district', 'like', '%'.$request->searchReservation.'%')
                        ->orWhere('apartament_descriptions.apartament_name', 'like', '%'.$request->searchReservation.'%')
                        ->orWhere('reservations.id', 'like', '%'.$request->searchReservation.'%');
                }
            })
            ->groupBy('id')
            ->orderBy($order, $orderByFuture)
            ->get();

        $users_reservations_gone = DB::table('reservations')
            ->select('reservations.*', 'apartaments.apartament_address', 'apartaments.apartament_address_2', 'apartaments.apartament_city', 'apartaments.apartament_district', 'apartament_descriptions.apartament_name', 'apartament_link', 'total_rating')
            ->distinct('id')
            ->leftjoin('apartaments', 'reservations.apartament_id', '=', 'apartaments.id')
            ->leftjoin('apartament_descriptions', 'reservations.apartament_id', '=', 'apartament_descriptions.apartament_id')
            ->leftjoin('apartament_opinions', 'reservations.id', 'apartament_opinions.id_reservation')
            ->where('user_id', Auth::user()->id)
            ->where('reservation_arrive_date', '<', $current_data)
            ->where(function($query) use ($request){
                if($request->searchReservation == NULL){
                    //
                }
                else{
                    $query->where('apartaments.apartament_address', 'like', '%'.$request->searchReservation.'%')
                        ->orWhere('apartaments.apartament_city', 'like', '%'.$request->searchReservation.'%')
                        ->orWhere('apartaments.apartament_district', 'like', '%'.$request->searchReservation.'%')
                        ->orWhere('apartament_descriptions.apartament_name', 'like', '%'.$request->searchReservation.'%')
                        ->orWhere('reservations.id', 'like', '%'.$request->searchReservation.'%');
                }
            })
            ->groupBy('id')
            ->orderBy($order, $orderByGone)
            ->get();

        if($users_reservations_future->isEmpty() && $users_reservations_gone->isEmpty()){

            $any_reservations = DB::table('reservations')
                ->where('user_id', Auth::user()->id)
                ->count();

            if($any_reservations == 0){
                $guidebooks = DB::table('guidebooks')
                    ->where('guidebook_language_id', $this->language->id)
                    ->limit(15)
                    ->get();

                return view('account.myReservations-empty', [
                    'guidebooks' => $guidebooks,
                ]);
            }
        }

        return view('account.myReservations', [
            'users_reservations_future' => $users_reservations_future,
            'users_reservations_gone' => $users_reservations_gone,
            'current_data' => $current_data,
            'request' => $request,
            'any_reservations' => $any_reservations ?? 1,
        ]);
    }

    public function opinions()
    {

        $current_data = date("Y-m-d");

        $users_opinions = DB::table('reservations')
            ->selectRaw('sub.opinionAmount, sub.ratingAvg, apartament_opinions.*, reservations.*, apartament_opinions.created_at AS opinionCreateDate, apartaments.apartament_address, apartaments.apartament_address_2, apartaments.apartament_city, apartaments.apartament_district, apartament_descriptions.apartament_name, apartament_link')
            ->leftjoin('apartaments', 'reservations.apartament_id', '=', 'apartaments.id')
            ->leftjoin(DB::raw('(select id_apartament, count(id_apartament) as opinionAmount, avg(total_rating) as ratingAvg from `reservations`
                cross join `apartament_opinions` on `reservations`.`id` = `apartament_opinions`.`id_reservation`  group by id_apartament) sub
            '), 'sub.id_apartament', '=', 'apartaments.id')
            ->leftjoin('apartament_opinions', 'reservations.id', '=', 'apartament_opinions.id_reservation')
            ->leftjoin('apartament_descriptions', 'reservations.apartament_id', '=', 'apartament_descriptions.apartament_id')
            ->where('user_id', Auth::user()->id)
            ->where('reservation_arrive_date', '<', $current_data)
            ->groupBy('reservations.id')
            ->orderBy('reservation_arrive_date', 'DESC')
            ->get();

        $opinionToAdd = 0;

        foreach($users_opinions as $opinion){
            if($opinion->total_rating == NULL) $opinionToAdd++;
        }

        return view('account.myOpinions', [
            'users_opinions' => $users_opinions,
            'current_data' => $current_data,
            'opinionToAdd' => $opinionToAdd,
            'buttonCheck' => $buttonCheck = 1,
        ]);

    }

    public function opinionsToAdd()
    {

        $current_data = date("Y-m-d");

        $users_opinions = DB::table('reservations')
            ->selectRaw('sub.opinionAmount, sub.ratingAvg, apartament_opinions.*, reservations.*, apartament_opinions.created_at AS opinionCreateDate, apartaments.apartament_address, apartaments.apartament_address_2, apartaments.apartament_city, apartaments.apartament_district, apartament_descriptions.apartament_name, apartament_link')
            ->leftjoin('apartaments', 'reservations.apartament_id', '=', 'apartaments.id')
            ->leftjoin(DB::raw('(select id_apartament, count(id_apartament) as opinionAmount, avg(total_rating) as ratingAvg from `reservations`
                cross join `apartament_opinions` on `reservations`.`id` = `apartament_opinions`.`id_reservation`  group by id_apartament) sub
            '), 'sub.id_apartament', '=', 'apartaments.id')
            ->leftjoin('apartament_opinions', 'reservations.id', '=', 'apartament_opinions.id_reservation')
            ->leftjoin('apartament_descriptions', 'reservations.apartament_id', '=', 'apartament_descriptions.apartament_id')
            ->where('user_id', Auth::user()->id)
            ->where('reservation_arrive_date', '<', $current_data)
            ->where('total_rating', null)
            ->groupBy('reservations.id')
            ->orderBy('reservation_arrive_date', 'DESC')
            ->get();

        $opinionToAdd = $users_opinions->count();

        return view('account.myOpinions', [
            'users_opinions' => $users_opinions,
            'current_data' => $current_data,
            'opinionToAdd' => $opinionToAdd,
            'buttonCheck' => $buttonCheck = 2,
        ]);

    }

    public function getOpinionDetails($apartamentId, $reservationId)
    {
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
            ->where('id_apartament', $apartamentId)
            ->first();

        $fiveStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '>=', 9);

        $fourStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '<', 9)
            ->where('total_rating', '>=', 7);

        $threeStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '<', 7)
            ->where('total_rating', '>=', 5);

        $twoStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '<', 5)
            ->where('total_rating', '>=', 3);

        $allStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '<', 3)
            ->unionAll($fiveStars)
            ->unionAll($fourStars)
            ->unionAll($threeStars)
            ->unionAll($twoStars)
            ->get();

        $userOpinion = DB::table('apartament_opinions')
            ->select('*')
            ->where('id_reservation', $reservationId)
            ->first();

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
            ->where('id_apartament', $apartamentId)
            ->where('journey_type', 0)
            ->first();

        $fiveStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '>=', 9)
            ->where('journey_type', 0);

        $fourStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '<', 9)
            ->where('total_rating', '>=', 7)
            ->where('journey_type', 0);

        $threeStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '<', 7)
            ->where('total_rating', '>=', 5)
            ->where('journey_type', 0);

        $twoStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '<', 5)
            ->where('total_rating', '>=', 3)
            ->where('journey_type', 0);

        $familyStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '<', 3)
            ->where('journey_type', 0)
            ->unionAll($fiveStars)
            ->unionAll($fourStars)
            ->unionAll($threeStars)
            ->unionAll($twoStars)
            ->get();

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
            ->where('id_apartament', $apartamentId)
            ->where('journey_type', 1)
            ->first();

        $fiveStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '>=', 9)
            ->where('journey_type', 1);

        $fourStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '<', 9)
            ->where('total_rating', '>=', 7)
            ->where('journey_type', 1);

        $threeStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '<', 7)
            ->where('total_rating', '>=', 5)
            ->where('journey_type', 1);

        $twoStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '<', 5)
            ->where('total_rating', '>=', 3)
            ->where('journey_type', 1);

        $couplesStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '<', 3)
            ->where('journey_type', 1)
            ->unionAll($fiveStars)
            ->unionAll($fourStars)
            ->unionAll($threeStars)
            ->unionAll($twoStars)
            ->get();

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
            ->where('id_apartament', $apartamentId)
            ->where('journey_type', 2)
            ->first();

        $fiveStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '>=', 9)
            ->where('journey_type', 2);

        $fourStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '<', 9)
            ->where('total_rating', '>=', 7)
            ->where('journey_type', 2);

        $threeStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '<', 7)
            ->where('total_rating', '>=', 5)
            ->where('journey_type', 2);

        $twoStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '<', 5)
            ->where('total_rating', '>=', 3)
            ->where('journey_type', 2);

        $businessStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '<', 3)
            ->where('journey_type', 2)
            ->unionAll($fiveStars)
            ->unionAll($fourStars)
            ->unionAll($threeStars)
            ->unionAll($twoStars)
            ->get();

        $withFriendsOpinions = DB::table('apartament_opinions')
            ->selectRaw('
                        count(*) as opinionsAmount,
                        round(avg(total_rating), 1) as totalAvg,
                        round(avg(cleanliness), 1) as cleanlinessAvg,
                        round(avg(location), 1) as locationAvg,
                        round(avg(facilities), 1) as facilitiesAvg,
                        round(avg(staff), 1) staffAvg,
                        round(avg(quality_per_price), 1) quality_per_priceAvg
                        ')
            ->where('id_apartament', $apartamentId)
            ->where('journey_type', 3)
            ->first();

        $fiveStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '>=', 9)
            ->where('journey_type', 3);

        $fourStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '<', 9)
            ->where('total_rating', '>=', 7)
            ->where('journey_type', 3);

        $threeStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '<', 7)
            ->where('total_rating', '>=', 5)
            ->where('journey_type', 3);

        $twoStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '<', 5)
            ->where('total_rating', '>=', 3)
            ->where('journey_type', 3);

        $withFriendsStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '<', 3)
            ->where('journey_type', 3)
            ->unionAll($fiveStars)
            ->unionAll($fourStars)
            ->unionAll($threeStars)
            ->unionAll($twoStars)
            ->get();

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
            ->where('id_apartament', $apartamentId)
            ->where('journey_type', 4)
            ->first();

        $fiveStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '>=', 9)
            ->where('journey_type', 4);

        $fourStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '<', 9)
            ->where('total_rating', '>=', 7)
            ->where('journey_type', 4);

        $threeStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '<', 7)
            ->where('total_rating', '>=', 5)
            ->where('journey_type', 4);

        $twoStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '<', 5)
            ->where('total_rating', '>=', 3)
            ->where('journey_type', 4);

        $aloneStars = DB::table('apartament_opinions')
            ->selectRaw('count(*) as amount')
            ->where('id_apartament', $apartamentId)
            ->where('total_rating', '<', 3)
            ->where('journey_type', 4)
            ->unionAll($fiveStars)
            ->unionAll($fourStars)
            ->unionAll($threeStars)
            ->unionAll($twoStars)
            ->get();

        return response()->json([$allOpinions, $userOpinion, $familyOpinions, $couplesOpinions, $businessOpinions, $withFriendsOpinions, $aloneOpinions, $allStars, $familyStars, $couplesStars, $businessStars, $withFriendsStars, $aloneStars]);
    }

    public function reservationDetail($idReservation){

        $reservation = DB::table('reservations')->where('id', $idReservation)->get();

        $id = $reservation[0]->apartament_id;

        $apartament = Apartament::with(array('descriptions' => function($query)
        {
            $query->where('language_id', $this->language->id);
        }))->find($id);

        $servicesDetails = DB::table('reservation_additional_services')
            ->join('additional_service_descriptions','reservation_additional_services.service_type','=','additional_service_descriptions.service_type_id')
            ->where('language_id', $this->language->id)
            ->where('id_reservation', $idReservation)
            ->get();

        $availableServices = DB::table('additional_services')
            ->join('additional_service_descriptions','additional_services.service_type','=','additional_service_descriptions.service_type_id')
            ->where('id_apartament', $id)
            ->whereNotIn('id', DB::table('reservation_additional_services')
            ->select('id_service')
            ->where('id_reservation', $idReservation))
            ->where('language_id', $this->language->id)
            ->get();

        $aboutUs = new App\AboutUs();
        $infos = $aboutUs->getAllContactInfo();

        return view('reservation.fourthStep', [
            'apartament' => $apartament,
            'reservation' => $reservation,
            'language' => $this->language->language_code,
            'servicesDetails' => $servicesDetails ?? 0,
            'availableServices' => $availableServices ?? 0,
            'infos' => $infos,
        ]);

    }

    public function reservationOpinion($idReservation){

        $reservation = DB::table('reservations')->where('id', $idReservation)->get();

        $id = $reservation[0]->apartament_id;

        $apartament = Apartament::with(array('descriptions' => function($query)
        {
            $query->where('language_id', $this->language->id);
        }))->find($id);

        return view('account.opinion', [
            'apartament' => $apartament,
            'reservation' => $reservation,
            'language' => $this->language->language_code,
            ]);
    }

    public function favourites(Request $request){

        $usersFavourites = DB::table('apartament_favourites')
            ->select('apartament_id')
            ->where('user_id', '=', Auth::user()->id)
            ->get()
            ->toArray();

        if (empty($usersFavourites)) return view('account.favourites.empty');

        $whereInData = [];

        foreach($usersFavourites as $value){
            array_push($whereInData, $value->apartament_id);
        }

        //set geo coordinates
        if($request->route()->getName() == 'myFavouritesMap'){
            switch($request->region){
                case "Kościelisko": $coordinates = '49.2902935, 19.8895826'; break;
                case "Witów": $coordinates = '49.3210546, 19.8265185'; break;
                case "Zakopane": default: $coordinates = '49.292166,19.952385'; break;
            }
        }

        if(isset($_GET['t-start'])){
            $backUrl = route("search", ["view"=>"kafle"])."?".http_build_query($request->except('_token'));
            session(["backToResults" => $backUrl]);
        }

        if(!isset($_GET['t-start']) && $request->route()->getName() != 'myFavouritesMap') {
            $finds = DB::table("apartaments")
                ->selectRaw('sub.opinionAmount, sub.ratingAvg, apartaments.*, apartament_descriptions.*, apartaments.id, MIN(price_value) AS min_price')
                ->leftJoin('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
                ->leftjoin(DB::raw('(select id_apartament, count(id_apartament) as opinionAmount, avg(total_rating) as ratingAvg from `reservations`
                cross join `apartament_opinions` on `reservations`.`id` = `apartament_opinions`.`id_reservation`  group by id_apartament) sub
                '), 'sub.id_apartament', '=', 'apartaments.id')
                ->leftJoin('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
                ->leftJoin('languages','apartament_descriptions.language_id', '=', 'languages.id')
                //->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
                ->whereIn('apartaments.id', $whereInData)
                ->where('language_id', $this->language->id)
                ->groupBy('apartaments.id')
                ->get();
            if(isset($request->sort)){
                switch($request->sort){
                    case 2: $finds = $finds->sortBy('min_price'); break;
                    case 3: $finds = $finds->sortByDesc('ratingAvg'); break;
                    case 4: $finds = $finds->sortByDesc('opinionAmount'); break;
                    case 5: $finds = $finds->sortBy("(ABS(apartament_geo_lat - $request->latitude)+ABS(apartament_geo_lan - $request->longitude))"); break;
                    case 1: default: $finds = $finds->sortBy('group_id'); break;
                }
            }
            $favouritesCount = $finds->count();
        }
        elseif(!isset($_GET['t-start']) && $request->route()->getName() == 'myFavouritesMap') {
            $finds = DB::table("apartaments")
                ->selectRaw('lastReservation.lastReservationDate, sub.opinionAmount, sub.ratingAvg, apartament_groups.*, apartament_descriptions.*, apartaments.id, MIN(price_value) AS min_price')
                ->leftJoin('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
                ->leftJoin('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
                ->leftJoin('apartament_groups','apartaments.group_id', '=', 'apartament_groups.group_id')
                ->leftJoin('languages','apartament_descriptions.language_id', '=', 'languages.id')
                ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
                ->leftjoin(DB::raw('(select group_id, id_apartament, count(id_apartament) as opinionAmount, avg(total_rating) as ratingAvg from `reservations`
                cross join `apartament_opinions` on `reservations`.`id` = `apartament_opinions`.`id_reservation` left join apartaments on id_apartament = apartaments.id group by apartaments.group_id) sub
            '), 'sub.group_id', '=', 'apartaments.group_id')
                ->leftjoin(DB::raw('(select apartament_id, reservations.created_at as lastReservationDate from `apartaments`
                right join `reservations` on `apartaments`.`id` = `reservations`.`id`  group by apartament_id) lastReservation
            '), 'lastReservation.apartament_id', '=', 'apartaments.id')
                ->where('language_id', $this->language->id)
                ->whereIn('apartaments.id', $whereInData)
                ->groupBy('apartaments.group_id')
                ->get();

            $findsWithoutGroup = DB::table("apartaments")
                ->selectRaw('sub.opinionAmount, sub.ratingAvg, apartaments.*, apartament_descriptions.*, apartaments.id, MIN(price_value) AS min_price')
                ->leftJoin('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
                ->leftjoin(DB::raw('(select id_apartament, count(id_apartament) as opinionAmount, avg(total_rating) as ratingAvg from `reservations`
                cross join `apartament_opinions` on `reservations`.`id` = `apartament_opinions`.`id_reservation`  group by id_apartament) sub
                '), 'sub.id_apartament', '=', 'apartaments.id')
                ->leftJoin('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
                ->leftJoin('languages','apartament_descriptions.language_id', '=', 'languages.id')
                //->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
                ->whereIn('apartaments.id', $whereInData)
                ->where('language_id', $this->language->id)
                ->where('group_id', 0)
                ->groupBy('apartaments.id')
                ->get();

            $favouritesCount = Session::get('userFavouritesAll')->count();
            return view('account.favourites.mapa', [
                'finds' => $finds,
                'findsWithoutGroup' => $findsWithoutGroup,
                'favouritesCount' => $favouritesCount,
                'request' => $request,
                'coordinates' => $coordinates,
                'black' => [],
                'blackGroups' => [],
                'gray' => [],
                'grayGroups' => [],
            ]);

        }
        elseif($request->route()->getName() == 'myFavouritesMap'){
            $request->amount = $request->Mamount ?? $request->amount;
            $request->amount2 = $request->Mamount2 ?? $request->amount2;
            if($request->amount == "1000+") $request->amount = 10000;
            if($request->amount2 == "1000+") $request->amount2 = 10000;
            $request->input('region') == $request->input('region') ?? '';
            $region = $request->input('region');

            $arriveDate = $request->input('t-start');
            $returnDate = $request->input('t-end');
            $dprz = strtotime($arriveDate);
            $dpwr = strtotime($returnDate);
            $nightsCounter = ($dpwr - $dprz)/(60 * 60 * 24);

            $whereData = [];
            if ($request->has('spa')) array_push($whereData, ['apartaments.apartament_spa', '1']);
            if ($request->has('garaz')) array_push($whereData, ['apartaments.apartament_parking', '1']);
            if ($request->has('kominek')) array_push($whereData, ['apartaments.apartament_fireplace', '1']);
            if ($request->has('balkon')) array_push($whereData, ['apartaments.apartament_balcony', '1']);
            if ($request->has('zwierzeta')) array_push($whereData, ['apartaments.apartament_animals', '1']);

            $finds = DB::table("apartaments")
                ->selectRaw('lastReservation.lastReservationDate, sub.opinionAmount, sub.ratingAvg, apartament_groups.*, apartament_descriptions.*, apartaments.id, MIN(price_value) AS min_price')
                ->leftJoin('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
                ->leftJoin('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
                ->leftJoin('apartament_groups','apartaments.group_id', '=', 'apartament_groups.group_id')
                ->leftJoin('languages','apartament_descriptions.language_id', '=', 'languages.id')
                ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
                ->leftjoin(DB::raw('(select group_id, id_apartament, count(id_apartament) as opinionAmount, avg(total_rating) as ratingAvg from `reservations`
                cross join `apartament_opinions` on `reservations`.`id` = `apartament_opinions`.`id_reservation` left join apartaments on id_apartament = apartaments.id group by apartaments.group_id) sub
            '), 'sub.group_id', '=', 'apartaments.group_id')
                ->leftjoin(DB::raw('(select apartament_id, reservations.created_at as lastReservationDate from `apartaments`
                right join `reservations` on `apartaments`.`id` = `reservations`.`id`  group by apartament_id) lastReservation
            '), 'lastReservation.apartament_id', '=', 'apartaments.id')
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
                ->whereBetween('price_value', array($request->amount ?? 0, $request->amount2 ?? 10000))
                ->whereBetween('date_of_price', array($arriveDate, $returnDate))
                ->where($whereData)
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
                ->where('apartaments.apartament_persons', '>=', $request->dorosli)
                ->where('apartaments.apartament_kids', '>=', $request->dzieci)
                ->whereIn('apartaments.id', $whereInData)
                ->groupBy('apartaments.group_id')
                ->get();

            $idFindsGroups = array();
            foreach($finds as $find){
                array_push($idFindsGroups , $find->group_id);
            }

            $blackGroups = DB::table("apartaments")
                ->selectRaw('apartament_groups.*, sub.ratingAvg, sub.opinionAmount, apartament_descriptions.*, apartaments.id, MIN(price_value) AS min_price')
                ->leftJoin('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
                ->leftJoin('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
                ->leftJoin('apartament_groups','apartaments.group_id', '=', 'apartament_groups.group_id')
                ->leftJoin('languages','apartament_descriptions.language_id', '=', 'languages.id')
                ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
                ->leftjoin(DB::raw('(select group_id, id_apartament, count(id_apartament) as opinionAmount, avg(total_rating) as ratingAvg from `reservations`
                        cross join `apartament_opinions` on `reservations`.`id` = `apartament_opinions`.`id_reservation` left join apartaments on id_apartament = apartaments.id group by apartaments.group_id) sub
                    '), 'sub.group_id', '=', 'apartaments.group_id')
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
                ->whereNotIn('apartaments.group_id', $idFindsGroups)
                ->where(function($query) use ($region){
                    if($region == NULL){
                        //
                    }
                    else{
                        $query->where('apartament_descriptions.apartament_name',$region)
                            ->orWhere('apartaments.apartament_city',$region);
                    }
                })
                ->whereIn('apartaments.id', $whereInData)
                ->where('apartaments.group_id', '>', 0)
                ->groupBy('apartaments.group_id')
                ->get();

            $blackGroupsIds = array();
            foreach($blackGroups as $blackId){
                array_push($blackGroupsIds, $blackId->group_id);
            }

            $blueAndBlackGroupsIds = array_merge($blackGroupsIds, $idFindsGroups);

            //apartaments not available in this term
            $grayGroups = DB::table("apartaments")
                ->selectRaw('apartament_groups.*, sub.ratingAvg, sub.opinionAmount, apartament_descriptions.*, apartaments.id, MIN(price_value) AS min_price')
                ->leftJoin('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
                ->leftJoin('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
                ->leftJoin('apartament_groups','apartaments.group_id', '=', 'apartament_groups.group_id')
                ->leftJoin('languages','apartament_descriptions.language_id', '=', 'languages.id')
                ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
                ->leftjoin(DB::raw('(select group_id, id_apartament, count(id_apartament) as opinionAmount, avg(total_rating) as ratingAvg from `reservations`
                        cross join `apartament_opinions` on `reservations`.`id` = `apartament_opinions`.`id_reservation` left join apartaments on id_apartament = apartaments.id group by apartaments.group_id) sub
                    '), 'sub.group_id', '=', 'apartaments.group_id')
                ->where('language_id', $this->language->id)
                ->whereNotIn('apartaments.group_id', $blueAndBlackGroupsIds)
                ->where(function($query) use ($region){
                    if($region == NULL){
                        //
                    }
                    else{
                        $query->where('apartament_descriptions.apartament_name',$region)
                            ->orWhere('apartaments.apartament_city',$region);
                    }
                })
                ->whereIn('apartaments.id', $whereInData)
                ->where('apartaments.group_id', '!=', 0)
                ->groupBy('apartaments.id')
                ->get();

//////////////////////////////////////////////////////////////////////////
            $findsWithoutGroup = DB::table("apartaments")
                ->selectRaw('sub.opinionAmount, sub.ratingAvg, apartaments.*, apartament_descriptions.*, apartaments.id, MIN(price_value) AS min_price')
                ->leftJoin('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
                ->leftjoin(DB::raw('(select id_apartament, count(id_apartament) as opinionAmount, avg(total_rating) as ratingAvg from `reservations`
                cross join `apartament_opinions` on `reservations`.`id` = `apartament_opinions`.`id_reservation`  group by id_apartament) sub
                '), 'sub.id_apartament', '=', 'apartaments.id')
                ->leftJoin('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
                ->leftJoin('languages','apartament_descriptions.language_id', '=', 'languages.id')
                //->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
                ->whereIn('apartaments.id', $whereInData)
                ->where('language_id', $this->language->id)
                ->where('group_id', 0)
                ->groupBy('apartaments.id')
                ->get();

            $idFinds = array();
            foreach($findsWithoutGroup as $find){
                array_push($idFinds, $find->id);
            }

            $black = DB::table("apartaments")
                ->selectRaw('apartaments.*, sub.ratingAvg, sub.opinionAmount, apartament_descriptions.*, apartaments.id, MIN(price_value) AS min_price')
                ->leftJoin('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
                ->leftJoin('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
                ->leftJoin('apartament_groups','apartaments.group_id', '=', 'apartament_groups.group_id')
                ->leftJoin('languages','apartament_descriptions.language_id', '=', 'languages.id')
                ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
                ->leftjoin(DB::raw('(select group_id, id_apartament, count(id_apartament) as opinionAmount, avg(total_rating) as ratingAvg from `reservations`
                        cross join `apartament_opinions` on `reservations`.`id` = `apartament_opinions`.`id_reservation` left join apartaments on id_apartament = apartaments.id group by apartaments.group_id) sub
                    '), 'sub.group_id', '=', 'apartaments.group_id')
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
                ->whereIn('apartaments.id', $whereInData)
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
                ->selectRaw('apartaments.*, sub.ratingAvg, sub.opinionAmount, apartament_descriptions.*, apartaments.id, MIN(price_value) AS min_price')
                ->leftJoin('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
                ->leftJoin('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
                ->leftJoin('apartament_groups','apartaments.group_id', '=', 'apartament_groups.group_id')
                ->leftJoin('languages','apartament_descriptions.language_id', '=', 'languages.id')
                ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
                ->leftjoin(DB::raw('(select group_id, id_apartament, count(id_apartament) as opinionAmount, avg(total_rating) as ratingAvg from `reservations`
                        cross join `apartament_opinions` on `reservations`.`id` = `apartament_opinions`.`id_reservation` left join apartaments on id_apartament = apartaments.id group by apartaments.group_id) sub
                    '), 'sub.group_id', '=', 'apartaments.group_id')
                ->where('language_id', $this->language->id)
                ->whereNotIn('apartaments.id', $blueAndBlackIds)
                ->where(function($query) use ($region){
                    if($region == NULL){
                        //
                    }
                    else{
                        $query->where('apartament_descriptions.apartament_name',$region)
                            ->orWhere('apartaments.apartament_city',$region);
                    }
                })
                ->whereIn('apartaments.id', $whereInData)
                ->where('apartaments.group_id', 0)
                ->groupBy('apartaments.id')
                ->get();

            $favouritesCount = Session::get('userFavouritesAll')->count();

            return view('account.favourites.mapa', [
                'finds' => $finds,
                'findsWithoutGroup' => $findsWithoutGroup,
                'favouritesCount' => $favouritesCount,
                'request' => $request,
                'coordinates' => $coordinates,
                'black' => $black ?? 0,
                'blackGroups' => $blackGroups ?? 0,
                'gray' => $gray ?? 0,
                'grayGroups' => $grayGroups ?? 0,
            ]);
        }
        else {

            switch($request->route()->getName()) {
                case 'myFavourites':
                    $view = 'kafle';
                    break;
                case 'myFavouritesList':
                    $view = 'lista';
                    break;
                case 'myFavouritesMap':
                    $view = 'mapa';
                    break;
                default:
                    $view = 'kafle';
                    break;
            }

            $request->amount = $request->Mamount ?? $request->amount;
            $request->amount2 = $request->Mamount2 ?? $request->amount2;
            if($request->amount == "1000+") $request->amount = 10000;
            if($request->amount2 == "1000+") $request->amount2 = 10000;
            $region = $request->input('region');

            $arriveDate = $request->input('t-start');
            $returnDate = $request->input('t-end');
            $dprz = strtotime($arriveDate);
            $dpwr = strtotime($returnDate);
            $nightsCounter = ($dpwr - $dprz)/(60 * 60 * 24);

            switch($view) {
                case 'kafle':
                    $paginate = 16;
                    break;
                case 'lista':
                    $paginate = 16;
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

            $finds = DB::table("apartaments")
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
                ->where('apartaments.apartament_persons', '>=', $request->dorosli ?? 0)
                ->where('apartaments.apartament_kids', '>=', $request->dzieci ?? 0)
                ->whereIn('apartaments.id', $whereInData)
                ->orderBy('min_price', 'ASC')
                ->groupBy('apartaments.id')
                ->get();

            switch($request->sort){
                case 2: $finds = $finds->sortBy('min_price'); break;
                case 3: $finds = $finds->sortByDesc('ratingAvg'); break;
                case 4: $finds = $finds->sortByDesc('opinionAmount'); break;
                case 5: case 1: default: $finds = $finds->sortBy('group_id'); break;
            }

            //->paginate($paginate, ['apartaments.id']);

            if($request->route()->getName() == 'myFavouritesMap'){
                $idFinds = array();
                foreach($finds as $find){
                    array_push($idFinds, $find->id);
                }
            }

            $favouritesCount = $finds->count();

            $finds = $finds->all();
            $finds = new Paginator($finds, $paginate);

            $black = 0;
            $gray = 0;

            if($request->route()->getName() == 'myFavouritesMap'){

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

            if ($favouritesCount === 0) return view('pages.results-none', ['nightsCounter' => $nightsCounter, 'notMeetCriteria' => $finds, 'request' => $request]);

        }

        $sortSelectArray = array(1=>__('messages.Best fit'), 2=>__('messages.Lowest price'), 3=>__('messages.Top rated'), 4=>__('messages.Most popular'), 5=>__('messages.Closest'));

        if ($request->route()->getName() == 'myFavourites') {
            return view('account.favourites.kafle', [
                'finds' => $finds,
                'favouritesCount' => $favouritesCount,
                'request' => $request,
                'sortSelectArray' => $sortSelectArray,
            ]);
        }
        else if($request->route()->getName() == 'myFavouritesList'){
            return view('account.favourites.lista', [
                'finds' => $finds,
                'favouritesCount' => $favouritesCount,
                'request' => $request,
                'sortSelectArray' => $sortSelectArray,
            ]);
        }
        else if($request->route()->getName() == 'myFavouritesCompare'){

            $account = new \App\Account();
            $finds = $account->getOtherEquipment($finds, $this->language->id);

            return view('account.favourites.compare', [
                'finds' => $finds,
                'favouritesCount' => $favouritesCount,
                'request' => $request,
                'sortSelectArray' => $sortSelectArray,
            ]);
        }

    }

    //Async send mail
    public function sendMail(Request $request){

        $emails = explode(',', str_replace(' ', '', $request->emails));

        $link = $request->links;

        if(\App::environment('production')){
            foreach($emails as $email){
                Mail::send('includes.mail_send-to-friends', ['link'=>$link], function($message) use ($email){
                    $message->to($email)
                        ->subject(__('messages.mailSub3'));
                    $message->from('kontakt@visitzakopane.pl','Otozakopane');
                });
            }
        }

        return response()->json('true');

    }

    //Async send mail
    public function sendMailConfirmation(Request $request){

        $emails = explode(',', str_replace(' ', '', $request->emails));

        $link = $request->link;

        if(\App::environment('production')){
            foreach($emails as $email){
                Mail::send('includes.mail_send-to-friends-confirmation', ['link'=>$link], function($message) use ($email){
                    $message->to($email)
                        ->subject(__('messages.mailSub2'));
                    $message->from('kontakt@visitzakopane.pl','Otozakopane');
                });
            }
        }

        return response()->json('true');

    }

    public function newConnectionFb(Request $request){

        DB::table('users')
            ->where('email', Auth::user()->email)
            ->update(['facebook_id' => $request->input("userID")]);

        return response()->json([
            'res' => 'true',
        ]);
    }

}
