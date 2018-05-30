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

    public function reservations()
    {

        $current_data = date("Y-m-d");

        $users_reservations_future = DB::table('reservations')
            ->select('reservations.*', 'apartaments.apartament_address', 'apartaments.apartament_address_2', 'apartaments.apartament_city', 'apartaments.apartament_district', 'apartament_descriptions.apartament_name', 'apartament_link')
            ->distinct('id')
            ->leftjoin('apartaments', 'reservations.apartament_id', '=', 'apartaments.id')
            ->leftjoin('apartament_descriptions', 'reservations.apartament_id', '=', 'apartament_descriptions.apartament_id')
            ->where('user_id', Auth::user()->id)
            ->where('reservation_arrive_date', '>=', $current_data)
            ->groupBy('id')
            ->orderBy('reservation_arrive_date', 'ASC')
            ->get();

        $users_reservations_gone = DB::table('reservations')
            ->select('reservations.*', 'apartaments.apartament_address', 'apartaments.apartament_address_2', 'apartaments.apartament_city', 'apartaments.apartament_district', 'apartament_descriptions.apartament_name', 'apartament_link')
            ->distinct('id')
            ->leftjoin('apartaments', 'reservations.apartament_id', '=', 'apartaments.id')
            ->leftjoin('apartament_descriptions', 'reservations.apartament_id', '=', 'apartament_descriptions.apartament_id')
            ->where('user_id', Auth::user()->id)
            ->where('reservation_arrive_date', '<', $current_data)
            ->groupBy('id')
            ->orderBy('reservation_arrive_date', 'DESC')
            ->get();

        return view('account.myReservations', [
            'users_reservations_future' => $users_reservations_future,
            'users_reservations_gone' => $users_reservations_gone,
            'current_data' => $current_data,
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

    public function reservationDetail($idAparment, $idReservation){

        $id = $idAparment;

        $apartament = Apartament::with(array('descriptions' => function($query)
        {
            $query->where('language_id', $this->language->id);
        }))->find($id);

        $reservation = DB::table('reservations')->where('id', $idReservation)->get();

        $servicesDetails = DB::table('reservation_additional_services')->where('id_reservation', $idReservation)->get();

        $availableServices = DB::table('additional_services')->where('id_apartament', $id)
            ->whereNotIn('id', DB::table('reservation_additional_services')->select('id_service')->where('id_reservation', $idReservation))
            ->get();

        return view('reservation.fourthStep', [
            'apartament' => $apartament,
            'reservation' => $reservation,
            'language' => $this->language->language_code,
            'servicesDetails' => $servicesDetails ?? 0,
            'availableServices' => $availableServices ?? 0,
        ]);

    }

    public function reservationOpinion($idAparment, $idReservation){

        $id = $idAparment;

        $apartament = Apartament::with(array('descriptions' => function($query)
        {
            $query->where('language_id', $this->language->id);
        }))->find($id);

        $reservation = DB::table('reservations')->where('id', $idReservation)->get();

        return view('account.opinion', [
            'apartament' => $apartament,
            'reservation' => $reservation,
            'language' => $this->language->language_code,
            ]);
    }

    public function favourites(){

        $usersFavourites = DB::table('apartament_favourites')
            ->select('id')
            ->where('user_id', '=', Auth::user()->id)
            ->get()
            ->toArray();

        if (is_null($usersFavourites)) return view('account.myFavouritesEmpty');

        $whereData = [];

        foreach($usersFavourites as $value){
            array_push($whereData, $value->id);
        }

        $finds = DB::table("apartaments")
            ->selectRaw('apartaments.*, apartament_descriptions.*, apartaments.id, MIN(price_value) AS min_price')
            ->leftJoin('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
            ->leftJoin('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
            ->leftJoin('languages','apartament_descriptions.language_id', '=', 'languages.id')
            //->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
            ->whereIn('apartaments.id', $whereData)
            ->where('language_id', $this->language->id)
            ->groupBy('apartaments.id')
            ->get();

        $favouritesCount = $finds->count();

        return view('account.myFavourites', [
            'finds' => $finds,
            'favouritesCount' => $favouritesCount,
        ]);

    }

}
