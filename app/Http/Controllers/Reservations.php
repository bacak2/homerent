<?php
/**
 *@category Kontroler rezerwacji, aplikacji HOMERENT
 *@author Krzysztof Baca
 *@version 1.0
 */


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\{Apartament, Apartament_description, Apartament_group, Reservation};
use Auth;


class Reservations extends Controller
{
    //Site language from database
    protected $language = 1;

    public function __construct()
    {
        $temp = \App::getLocale();
        $language = DB::table('languages')->select('id', 'language_code')->where('language_code',$temp)->first();
        $this->language = $language;
    }
    
    public function firstStep(Request $request){
        $przyjazdDb = explode(" ", $request->przyjazd);
        //zmienić gdy kalendarz będzie wszędzie taki sam (z dniem tygodnia słownie)
        $przyjazdDb = $przyjazdDb[1] ?? $przyjazdDb[0];
        $przyjazdDb = date("Y-m-d", strtotime($przyjazdDb));
        $powrotDb = explode(" ", $request->powrot);
        $powrotDb = $powrotDb[1] ?? $powrotDb[0];
        $powrotDb = date("Y-m-d", strtotime($powrotDb));

        $dprz = strtotime($przyjazdDb);
        $dpwr = strtotime($powrotDb);
        $nightsCounter = ($dpwr - $dprz)/(60 * 60 * 24);

        $link = $request->link;
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

        //Generates an array of images gallery
        $images = DB::table('apartaments')
            ->select('apartament_photos.photo_link','apartaments.id')
            ->join('apartament_photos','apartaments.id','=','apartament_photos.apartament_id')
            ->where('apartament_id',$id)
            ->get();

        $priceFrom = $this->getPriceFrom($id);

        //suma wszystkich łóżek
        $beds = $apartament->apartament_single_beds+$apartament->apartament_double_beds;

        return view('reservation.firstStep', [
            'apartament' => $apartament,
            'images' => $images,
            'priceFrom' => $priceFrom,
            'beds' => $beds,
            'request' => $request,
            'przyjazdDb' => $przyjazdDb,
            'powrotDb' => $powrotDb,
            'ileNocy' => $nightsCounter,
        ]);

    }

    public function secondStep(Request $request){

        $link = $request->link;
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

        //Generates an array of images gallery
        $images = DB::table('apartaments')
            ->select('apartament_photos.photo_link','apartaments.id')
            ->join('apartament_photos','apartaments.id','=','apartament_photos.apartament_id')
            ->where('apartament_id',$id)
            ->get();

        $priceFrom = $this->getPriceFrom($id);

        //suma wszystkich łóżek
        $beds = $apartament->apartament_single_beds+$apartament->apartament_double_beds;

        return view('reservation.secondStep', ['apartament' => $apartament,
            'images' => $images,
            'priceFrom' => $priceFrom,
            'beds' => $beds,
            'request' => $request,
        ]);

    }

    public function thirdStep(Request $request)
    {
        //dd($request);
        $dataSet = array(
            'apartament_id' => $request->id,
            'user_id' => Auth::user()->id ?? 0,
            'title' => $request->title,
            'name_and_surname' => $request->name_and_surname,
            'country' => $request->country,
            'address' => $request->address,
            'address_invoice' => $request->address_invoice ?? $request->address,
            'postcode' => $request->postcode,
            'postcode_invoice' => $request->postcode_invoice ?? $request->postcode,
            'place' => $request->place,
            'place_invoice' => $request->place_invoice ?? $request->place,
            'company_name' => $request->company_name,
            'nip' => $request->nip,
            'phone' => $request->phone,
            'email' => $request->email,
            'reservation_arrive_date' => $request->przyjazdDb,
            'reservation_departure_date' => $request->powrotDb,
            'reservation_persons' => $request->dorosli,
            'reservation_kids' => $request->dzieci,
            'reservation_nights' => $request->ilenocy,
            'reservation_additional_message' => $request->wiadomoscDodatkowa,
            'reservation_arrive_time' => $request->godzinaPrzyjazdu,
            'reservation_advance' => $request->zal,
            'reservation_payment' => $request->allNow,
            'reservation_status' => 0
        );

        if($request->zal == 2 || $request->allNow == 2) {

            $idReservation = DB::table('reservations')->insertGetId($dataSet);

            return redirect()->action(
                'Reservations@fourthStep', ['idAparment' => $request->id, 'idReservation' => $idReservation]
            );
        }

        else {
            return view('reservation.thirdStep');
        }
    }

    public function fourthStep($idAparment, $idReservation){

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

}
