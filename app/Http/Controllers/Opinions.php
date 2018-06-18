<?php
/**
 *@category Kontroler usług dodatkowych, aplikacji HOMERENT
 *@author Krzysztof Baca
 *@version 1.0
 */


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class Opinions extends Controller
{
    //Site language from database
    protected $language = 1;

    public function __construct()
    {
        $temp = \App::getLocale();
        $language = DB::table('languages')->select('id', 'language_code')->where('language_code',$temp)->first();
        $this->language = $language;
    }

    public function addOpinion(Request $request){

        if(!$request->has('anonymously')){
            $user = DB::table('users_account')->select('country', 'place')->where('email', Auth::user()->email)->first();
            $userName = Auth::user()->name;
            $userCountry = $user->country ?? 'Polska';
            $userCity = $user->place ?? '';
        }

        $opinionData = array(
            'id_apartament' => $request->apartament,
            'id_reservation' => $request->reservation,
            'id_user' => Auth::user()->id ?? 0,
            'total_rating' => $request->overall,
            'pros' => $request->pros,
            'cons' => $request->cons,
            'cleanliness' => $request->cleanliness,
            'location' => $request->location,
            'facilities' => $request->facilities,
            'staff' => $request->staff,
            'quality_per_price' => $request->quality_per_price,
            'user_name' => $userName ?? 0,
            'user_country' => $userCountry ?? 0,
            'user_city' => $userCity ?? 0,
            'journey_type' => $request->type,
            'created_at' => date("Y-m-d H:i:s", time()),
        );

        if(DB::table('apartament_opinions')->where('id_reservation', $request->reservation)->first() != null) DB::table('apartament_opinions')->where('id_reservation', $request->reservation)->delete();

        DB::table('apartament_opinions')->insert($opinionData);

        $visitDate = DB::table('reservations')->select('reservation_arrive_date')->where('id', $request->reservation)->first();

        switch($request->type){
            case 0: $journey_type = 'Rodzina'; break;
            case 1: $journey_type = 'Para'; break;
            case 2: $journey_type = 'Biznesowa'; break;
            case 3: $journey_type = 'Ze znajomymi'; break;
            case 4: $journey_type = 'W pojedynkę'; break;
        }

        return view('account.opinionAdded', [
            'opinionData' => $opinionData,
            'visitDate' => $visitDate,
            'journey_type' => $journey_type,
        ]);
    }

    public function deleteOpinion($reservationId){

        DB::table('apartament_opinions')->where('id_reservation', $reservationId)->delete();

        return response()->json([
            'res' => 'true',
        ]);
    }
}
