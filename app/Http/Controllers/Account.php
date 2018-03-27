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
        $language = DB::table('languages')->select('id')->where('language_code',$temp)->first();
        $this->language = $language;
    }

    public function index()
    {
        $users_account = DB::table('users_account')->where('user_email', Auth::user()->email)->get();
        
        return view('account.data', [
            'users_account' => $users_account,
        ]);
    }

    public function refreshView()
    {
        $usersAccount = DB::table('users_account')->get();

        return response(json_encode($usersAccount));
    }
    
    public function add(Request $request)
    {
        $email = $request->input('email');

        $dataSet[] = [
            'name'  => $request->input('name'),
            'user_email' => $request->input('email'),
        ];

        DB::table('users_account')->insert($dataSet);

        return response()->json([
            'res' => $email,
        ]);
    }

    public function editItem($id){
        $userAccount = DB::table('users_account')->select('name', 'surname')->where('id', $id)->get();

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
        $users_reservations = DB::table('reservations')
            ->leftjoin('apartaments', 'reservations.apartament_id', '=', 'apartaments.id')
            ->leftjoin('apartament_descriptions', 'reservations.apartament_id', '=', 'apartament_descriptions.apartament_id')
            ->where('user_id', Auth::user()->id)
            ->select('reservations.*', 'apartaments.apartament_address', 'apartaments.apartament_address_2', 'apartaments.apartament_city', 'apartament_descriptions.apartament_name', 'apartament_link')
            ->distinct('id')
            ->orderBy('reservation_arrive_date', 'DESC')
            ->get();

//dd($users_reservations);
        return view('account.myReservations', [
            'users_reservations' => $users_reservations,
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
        ]);

    }

    public function favourites()
    {
        
    }

}
