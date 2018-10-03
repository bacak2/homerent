<?php
/**
 * Created by PhpStorm.
 * User: adminartplus
 * Date: 29.05.18
 * Time: 09:02
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Session;

class Favourites extends Controller
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

    public function addToFavourites($apartmentId, $userId){

        $added = $this->addNew($apartmentId, $userId);

        if($added == true) {

            $this->reloadFavouritesInSession();
            return response()->json([1, Session::get('userFavouritesCount'), Session::get('userFavourites'), Session::get('userFavouritesAll')]);

        }

        return response()->json([0, Session::get('userFavouritesCount'), Session::get('userFavourites'), Session::get('userFavouritesAll')]);

    }

    public function truncateFavourites($userId){

        DB::table('apartament_favourites')
            ->where('user_id', '=', $userId)
            ->delete();

        $this->reloadFavouritesInSession();

        return response()->json("true");

    }

    public function addNew($apartmentId, $userId){

        $user_favourites = DB::table('apartament_favourites')
            ->where('apartament_id', '=', $apartmentId)
            ->where('user_id', '=', $userId)
            ->first();

        if(is_null($user_favourites)){
            DB::table('apartament_favourites')->insert(
                ['apartament_id' => $apartmentId, 'user_id' => $userId]
            );

            $this->reloadFavouritesInSession();

            return true;
        }

        else return false;
    }

    public function reloadFavouritesInSession(){

        $userFavouritesCount = DB::table('apartament_favourites')
            ->select('id')
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        $userFavouritesCount = $userFavouritesCount->count();

        $userFavourites = DB::table('apartament_favourites')
            ->select('apartaments.id', 'apartament_descriptions.apartament_name', 'apartament_address', 'apartament_address_2', 'apartament_descriptions.apartament_link')
            ->distinct('apartaments.id')
            ->join('apartament_descriptions','apartament_favourites.apartament_id', '=', 'apartament_descriptions.apartament_id')
            ->join('apartaments','apartament_favourites.apartament_id', '=', 'apartaments.id')
            ->where('user_id', '=', Auth::user()->id)
            ->orderBy('apartament_favourites.created_at', 'desc')
            ->limit(3)
            ->get();

        $userFavouritesAll = DB::table('apartament_favourites')
            ->select('apartaments.id', 'apartament_descriptions.apartament_name', 'apartament_address', 'apartament_address_2', 'apartament_descriptions.apartament_link')
            ->distinct('apartaments.id')
            ->join('apartament_descriptions','apartament_favourites.apartament_id', '=', 'apartament_descriptions.apartament_id')
            ->join('apartaments','apartament_favourites.apartament_id', '=', 'apartaments.id')
            ->where('user_id', '=', Auth::user()->id)
            ->orderBy('apartament_favourites.created_at', 'desc')
            ->get();

        session(['userFavouritesCount' => $userFavouritesCount]);

        session(['userFavourites' => $userFavourites]);

        session(['userFavouritesAll' => $userFavouritesAll]);

        return true;
    }

    public function deleteFromFavourites($apartmentId, $userId){

        DB::table('apartament_favourites')
            ->where('apartament_id', '=', $apartmentId)
            ->where('user_id', '=', $userId)
            ->delete();

        $this->reloadFavouritesInSession();

        return response()->json([__('messages.AddToFav4'), Session::get('userFavouritesCount'), Session::get('userFavourites'), Session::get('userFavouritesAll')]);
    }

    public function compare(){

        $usersFavourites = DB::table('apartament_favourites')
            ->select('apartament_id')
            ->where('user_id', '=', Auth::user()->id)
            ->get()
            ->toArray();

        if (empty($usersFavourites)) return view('account.favourites.empty');

        $whereData = [];

        foreach($usersFavourites as $value){
            array_push($whereData, $value->apartament_id);
        }

        $finds = DB::table("apartaments")
            ->selectRaw('sub.opinionAmount, sub.ratingAvg, apartaments.*, apartament_descriptions.*, apartaments.id, MIN(price_value) AS min_price')
            ->leftJoin('apartament_favourites','apartaments.id', '=', 'apartament_favourites.apartament_id')
            ->leftjoin(DB::raw('(select id_apartament, count(id_apartament) as opinionAmount, avg(total_rating) as ratingAvg from `reservations`
                cross join `apartament_opinions` on `reservations`.`id` = `apartament_opinions`.`id_reservation`  group by id_apartament) sub
            '), 'sub.id_apartament', '=', 'apartaments.id')
            ->leftJoin('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
            ->leftJoin('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
            ->leftJoin('languages','apartament_descriptions.language_id', '=', 'languages.id')
            //->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
            ->whereIn('apartaments.id', $whereData)
            ->where('language_id', $this->language->id)
            ->groupBy('apartaments.id')
            ->orderBy('apartament_favourites.created_at', 'desc')
            ->get();

        $favouritesCount = $finds->count();

        return view('account.favourites.compare', [
            'finds' => $finds,
            'favouritesCount' => $favouritesCount,
        ]);

    }
}