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
            ->orderBy('reservation_arrive_date', 'ASC')
            ->get();

        $users_reservations_gone = DB::table('reservations')
            ->select('reservations.*', 'apartaments.apartament_address', 'apartaments.apartament_address_2', 'apartaments.apartament_city', 'apartaments.apartament_district', 'apartament_descriptions.apartament_name', 'apartament_link')
            ->distinct('id')
            ->leftjoin('apartaments', 'reservations.apartament_id', '=', 'apartaments.id')
            ->leftjoin('apartament_descriptions', 'reservations.apartament_id', '=', 'apartament_descriptions.apartament_id')
            ->where('user_id', Auth::user()->id)
            ->where('reservation_arrive_date', '<', $current_data)
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
            ->selectRaw('apartament_opinions.*, reservations.*, apartament_opinions.created_at AS opinionCreateDate, apartaments.apartament_address, apartaments.apartament_address_2, apartaments.apartament_city, apartaments.apartament_district, apartament_descriptions.apartament_name, apartament_link')
            ->leftjoin('apartaments', 'reservations.apartament_id', '=', 'apartaments.id')
            ->leftjoin('apartament_opinions', 'reservations.id', '=', 'apartament_opinions.id_reservation')
            ->leftjoin('apartament_descriptions', 'reservations.apartament_id', '=', 'apartament_descriptions.apartament_id')
            ->where('user_id', Auth::user()->id)
            ->where('reservation_arrive_date', '<', $current_data)
            ->groupBy('reservations.id')
            ->orderBy('reservation_arrive_date', 'DESC')
            ->get();

//dd($users_opinions);

        return view('account.myOpinions', [
            'users_opinions' => $users_opinions,
            'current_data' => $current_data,
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
        return response()->json([$allOpinions, $userOpinion, $familyOpinions]);
    }

    public function reservationDetail($idAparment, $idReservation){

        $id = $idAparment;

        $apartament = Apartament::with(array('descriptions' => function($query)
        {
            $query->where('language_id', $this->language->id);
        }))->find($id);

        $reservation = DB::table('reservations')->where('id', $idReservation)->get();

        return view('reservation.fourthStep', [
            'apartament' => $apartament,
            'reservation' => $reservation,
            'language' => $this->language->language_code,
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

    public function favourites()
    {
        
    }

}
