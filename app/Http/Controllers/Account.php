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
        $usersAccount = DB::table('users_account')->get();

        return response(json_encode($usersAccount));
    }
    
    public function save(Request $request)
    {
        if ($request->input('id') != 0){
            DB::table('users_account')
                ->where('id', $request->input('id'))
                ->where('user_email', $request->input('user_email'))
                ->update([
                    'name' => $request->input('name'),
                    'surname' => $request->input('surname'),
                    'address' => $request->input('address'),
                    'postcode' => $request->input('postcode'),
                    'place' => $request->input('place'),
                    'phone' => $request->input('phone'),
                    'email' => $request->input('email'),
                ]);
        }

        else {
            $dataSet[] = [
                'name'  => $request->input('name'),
                'surname' => $request->input('surname'),
                'address' => $request->input('address'),
                'postcode' => $request->input('postcode'),
                'place' => $request->input('place'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'user_email' => $request->input('user_email'),
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
