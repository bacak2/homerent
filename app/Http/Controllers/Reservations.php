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
use Crypt;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade as PDF;
use View;

class Reservations extends Controller
{
    //Site language from database
    protected $language = 1;
    protected $languageCode = 'pl';
    protected $idReservationOtozakopane;
    protected $idReservationVisit;

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
        $request->przyjazd = $przyjazdDb = date("Y-m-d", strtotime($przyjazdDb));
        $powrotDb = explode(" ", $request->powrot);
        $powrotDb = $powrotDb[1] ?? $powrotDb[0];
        $request->powrot = $powrotDb = date("Y-m-d", strtotime($powrotDb));
        if(isset($_GET['t-start'])) $request->przyjazd = $przyjazdDb = $_GET['t-start'];
        if(isset($_GET['t-end'])) $request->powrot = $powrotDb = $_GET['t-end'];
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

        $totalPrice = DB::Table('apartament_prices')
            ->selectRaw('sum(price_value) AS total_price')
            ->where('apartament_id',$id)
            ->where('date_of_price','>=',$przyjazdDb)
            ->where('date_of_price','<',$powrotDb)
            ->first();

        $prices = DB::Table('apartament_prices')
            ->select('date_of_price', 'price_value')
            ->where('apartament_id',$id)
            ->where('date_of_price','>=',$przyjazdDb)
            ->where('date_of_price','<',$powrotDb)
            ->get();

        $priceFrom = $this->getPriceFrom($id);

        //get avilable services
        $additionalServices = DB::table('additional_services')
            ->where('id_apartament',$id)
            ->get();

        //suma wszystkich łóżek
        $beds = $apartament->apartament_single_beds+$apartament->apartament_double_beds;

        $cleaning = $apartament->final_cleaning_price;
        $basicService = $apartament->basic_service_price;
        $request->fullPrice = $totalPrice->total_price + $request->servicesPrice + $cleaning + $basicService;

        //get rating of this apartment
        $opinion = DB::table('apartament_opinions')
            ->selectRaw('count(id_apartament) as opinionAmount, avg(total_rating) as ratingAvg')
            ->where('id_apartament',$id)
            ->first();

        return view('reservation.firstStep', [
            'apartament' => $apartament,
            'images' => $images,
            'priceFrom' => $priceFrom,
            'beds' => $beds,
            'request' => $request,
            'przyjazdDb' => $przyjazdDb,
            'powrotDb' => $powrotDb,
            'ileNocy' => $nightsCounter,
            'totalPrice' => $totalPrice->total_price,
            'prices' => $prices,
            'cleaning' => $cleaning,
            'basicService' => $basicService,
            'additionalServices' => $additionalServices,
            'opinion' => $opinion,
        ]);

    }

    public function secondStep(Request $request){

        $reservation = new Reservation();
        $availability = $reservation->checkAvailabity($request->id, $request->przyjazdDb, $request->powrotDb);

        if($availability == null){
            return redirect()->route('reservations.unavailable', [
                'id' => $request->id,
                't-start' => $request->przyjazdDb,
                't-end' => $request->powrotDb,
                'dorosli' => $request->dorosli,
                'dzieci' => $request->dzieci,
            ]);
        }

        $filtered = array();
        $collectionOfServices = Collection::make([]);

        foreach($request->request as $key => $value){
            if(preg_match('/additional\d/', $key)) {
                //dd($key);
                $collection = array(array());
                $id = substr($key, 10);
                $filtered[] = $id;
                $found = 0;
                foreach ($request->request as $key => $value) {
                    if (preg_match("/persons-$id/", $key)) {
                        //$persons[] = [substr($key, 8) => $value];
                        $collection[$id][$key+1] = $value;
                    }
                    if (preg_match("/days-$id/", $key)) {
                        //$days[] = [substr($key, 5) => $value];
                        $collection[$id][$key+2] = $value;
                        $collectionOfServices->push($collection);
                        $found = 1;
                    }
                }
                if($found == 0){
                    $collection[$id][1] = '1';
                    $collection[$id][2] = '1';
                    $collectionOfServices->push($collection);
                }
            }
        }

        $servicesDetails = DB::table('reservation_additional_services')->where('id_reservation', session()->getId())->get();
        if($servicesDetails->count() > 0) DB::table('reservation_additional_services')->where('id_reservation', session()->getId())->delete();

        foreach($collectionOfServices as $service){
            foreach($service as $key => $value){
                if ($key == 0) continue;
                $serviceDetails = DB::table('additional_services')->select('name', 'price', 'with_options')->where('id', $key)->first();
                $withOptions = $serviceDetails->with_options;
                if($withOptions == 0){
                    $price = $serviceDetails->price;
                }
                elseif($withOptions == 2){
                    $price = $serviceDetails->price*$service[$key][1]*$service[$key][2];
                }

                $servicesData = array(
                    'id_reservation' => session()->getId(),
                    'id_service' => $key,
                    'name' => $serviceDetails->name,
                    'price' => $price,
                    'nights' => $service[$key][2] ?? 0,
                    'adults' => $service[$key][1] ?? 0,
                    'with_options' => $withOptions,
                );
                DB::table('reservation_additional_services')->insert($servicesData);
            }
        }

        $servicesDetails = DB::table('reservation_additional_services')->where('id_reservation', session()->getId())->get();

        if($request->session()->get('couponValue') != null){
            $request->payment_all_nights = $request->payment_all_nights - $request->session()->get('couponValue');
            $request->session()->forget('couponValue');
        }

        $request->fullPrice = $request->payment_all_nights + $request->servicesPrice + $request->payment_basic_service + $request->payment_final_cleaning;

        if(Auth::user()){
            $accountData = DB::table('users_account')->where('user_email', Auth::user()->email)->get();
        }
        else{
            $accountData = 0;
        }

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

        if($this->language->language_code == "PL"){
            $countries = DB::table('countries')->orderBy('pl')->pluck('pl', 'pl');
            $defaultCountry = 'Polska';
        }
        else{
            $countries = DB::table('countries')->orderBy('en')->pluck('en', 'en');
            $defaultCountry = 'Poland';
        }

        return view('reservation.secondStep', [
            'apartament' => $apartament,
            'images' => $images,
            'priceFrom' => $priceFrom,
            'beds' => $beds,
            'request' => $request,
            'accountData' => $accountData,
            'servicesDetails' => $servicesDetails,
            'countries' => $countries,
            'defaultCountry' => $defaultCountry,
        ]);

    }

    public function thirdStep(Request $request)
    {
        $reservation = new Reservation();
        //$availability = $reservation->checkAvailabity($request->id, $request->przyjazdDb, $request->powrotDb);
        $availability = 1;
        if($availability == null){
            return redirect()->route('reservations.unavailable', [
                'id' => $request->id,
                't-start' => $request->przyjazdDb,
                't-end' => $request->powrotDb,
                'dorosli' => $request->dorosli,
                'dzieci' => $request->dzieci,
            ]);
        }

        $request->phone = "$request->prefix"." $request->phone";
        $request->fullPrice = Crypt::decrypt($request->fullPrice);

        if(!(Auth::user() || $request->has('dontWantAccount'))){

            $emailExists = DB::table('users')->where('email', $request->email)->exists();
            if($emailExists) {
                return redirect()->back()->withInput()->withErrors('Dla podanego adresu email istnieje już konto');
            }
            else {
                $usersDataSet = array(
                    'name'  => $request->input('name'),
                    'surname' => $request->input('surname'),
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password')),
                );

                $usersAccountDataSet = array(
                    'title' => $request->title,
                    'label' => $request->name,
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'country' => $request->country,
                    'address' => $request->address,
                    'address_invoice' => $request->address_invoice ?? '',
                    'postcode' => $request->postcode,
                    'postcode_invoice' => $request->postcode_invoice ?? '',
                    'place' => $request->place,
                    'place_invoice' => $request->place_invoice ?? '',
                    'company_name' => $request->company_name ?? '',
                    'nip' => $request->nip ?? '',
                    'phone' => $request->phone,
                    'user_email' => $request->email,
                    'email' => $request->email,
                    'invoice' => $request->wantInvoice ?? 0,
                );

                $insertedUserId = DB::table('users')->insertGetId($usersDataSet);
                DB::table('users_account')->insert($usersAccountDataSet);
            }
        }

        $reservationData =[
            'apartament_id' => $request->id,
            'user_id' => Auth::user()->id ?? $insertedUserId ?? 0,
            'reservation_arrive_date' => $request->przyjazdDb,
            'reservation_departure_date' => $request->powrotDb,
            'reservation_persons' => $request->dorosli,
            'reservation_kids' => $request->dzieci,
            'reservation_nights' => $request->ilenocy,
            'reservation_additional_message' => $request->wiadomoscDodatkowa,
            'reservation_arrive_time' => $request->godzinaPrzyjazdu,
            'reservation_advance' => $request->zal,
            'reservation_payment' => $request->payment_method,
            'payment_full_amount' => $request->fullPrice,
            'payment_to_pay' => $request->fullPrice,
            'payment_all_nights' => $request->payment_all_nights,
            'payment_final_cleaning' => $request->payment_final_cleaning,
            'payment_additional_services' => $request->payment_additional_services,
            'payment_basic_service' => $request->payment_basic_service,
            'reservation_status' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ];

        if(isset($request->idActive) && is_numeric($request->idActive)){
            $userData = DB::table('users_account')->where('id', $request->idActive)->get();
            $userData = collect($userData)->map(function($x){ return (array) $x; })->toArray();
            $userData = $userData[0];

            if($userData["country"] == null) $userData["country"] = $request->country;
            if($userData["address"] == null) $userData["address"] = $request->address;
            if($userData["postcode"] == null) $userData["postcode"] = $request->postcode;
            if($userData["place"] == null) $userData["place"] = $request->place;
            if($userData["phone"] == null) $userData["phone"] = $request->phone;

            unset($userData['id']);
            unset($userData['user_email']);
            unset($userData['label']);
        }
        else {
            $userData = array(
                'title' => $request->title,
                'name' => $request->name,
                'surname' => $request->surname,
                'country' => $request->country,
                'address' => $request->address,
                'address_invoice' => $request->address_invoice ?? '',
                'postcode' => $request->postcode,
                'postcode_invoice' => $request->postcode_invoice ?? '',
                'place' => $request->place,
                'place_invoice' => $request->place_invoice ?? '',
                'company_name' => $request->company_name ?? '',
                'nip' => $request->nip ?? '',
                'phone' => $request->phone,
                'email' => $request->email,
                'invoice' => $request->wantInvoice ?? 0,
            );
        }

        if(isset($request->idActive)&& $request->idActive == 'addNew'){
            $dataSet[] = [
                'name'  => $request->input('name'),
                'surname' => $request->input('surname'),
                'address' => $request->input('address'),
                'postcode' => $request->input('postcode'),
                'place' => $request->input('place'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'user_email' => Auth::user()->email,
            ];

            DB::table('users_account')->insert($dataSet);
        }

        $dataSet = $reservationData + $userData;

        $visitApartamentId = DB::table('visitzakopane_apartaments_ids')
            ->select('visitzakopane_id')
            ->where('otozakopane_id', $request->id)
            ->first();

        $visitDataSet[] = [
            'apartament_id'  => $visitApartamentId->visitzakopane_id,
            'reservation_date_p' => $request->przyjazdDb,
            'reservation_date_k' => $request->powrotDb,
            'reservation_data' => date('Y-m-d H:i:s'),
            'reservation_status' => '12', //rezerwacja obca
            'reservation_persons' => '1',
            'reservation_kids' => '0',
            'reservation_kids_age' => '0',
            'reservation_wplacona_zaliczka' => '0',
            'reservation_druga_wplata' => '0',
            'zapl_gotowka_pln' => '0',
            'zapl_karta_pln' => '0',
            'zapl_gotowka_eur' => '0',
            'zapl_karta_eur' => '0',
            'zapl_karta_waw_pln' => '0',
            'zapl_karta_waw_eur' => '0',
            'wplata_rezydenta_pln' => '0',
            'wplata_rezydenta_eur' => '0',
            'reservation_number' => '0',
            'konsultant_id' => '0',
            'reservation_data_waznosci_2' => '0000-00-00 00:00:00.000000',
            'reservation_data_waznosci_sort' => '0000-00-00 00:00:00.000000',
            'reservation_services' => '0',
            'reservation_consultant' => '0',
            'reservation_parking_or_garage' => '0',
            'reservation_wyjechal_date' => '0000-00-00 00:00:00.000000',
            'reservation_przyjechal_date' => '0000-00-00 00:00:00.000000',
            'reservation_wyjechal_caretaker' => '0',
            'reservation_attentions' => '0',
            'reservation_departure_time' => '0',
            'add_to_caretaker_account' => '0',
            'wirtualne_pieniadze' => '0',
            'wirtualne_pieniadze_opis' => '',
            'wystawiono_faktury' => '0',
            'gosc_zagraniczny' => '0',
            'ceny_pobytu_by_day' => '0',
            'used_promotion' => '0',
            'want_invoice' => '0',
            'ankieta_unique' => '0',
            'platnosci_unique' => '0',
            'kod_promocyjny' => '0',
            'from_portal' => 'Otozakopane',
        ];

        //adding reservation if there is no visitzakopane
        //$this->idReservationOtozakopane = DB::table('reservations')->insertGetId($dataSet);

        //something like transaction - do both function or none
        try{
            $this->idReservationOtozakopane = $idReservation = DB::connection('mysql')->table('reservations')->insertGetId($dataSet);
            DB::connection('mysql2')->table('visit_reservations')->insert($visitDataSet, 'reservation_id');
            $this->idReservationVisit = DB::connection('mysql2')->getPdo()->lastInsertId();
        }catch(\Exception $e){
            if($this->idReservationOtozakopane != false) DB::connection('mysql')->table('reservations')->where('id', $this->idReservationOtozakopane)->delete();
            if($this->idReservationVisit != false) DB::connection('mysql2')->table('visit_reservations')->where('reservation_id', $this->idReservationVisit)->delete();
            return $e->getMessage();
        }

        //change reservation_id of additional services to real id
        DB::table('reservation_additional_services')->where('id_reservation', session()->getId())->update(['id_reservation' => $this->idReservationOtozakopane]);

        if($request->payment_method == 2 || $request->payment_method == 4) {
            return redirect()->action(
                'Reservations@fourthStep', [
                    'idAparment' => $request->id,
                    'idReservation' => $this->idReservationOtozakopane,
                ]
            );
        }

        //online payment
        else {
            if ($request->payment_method == 1) $toPay = $request->fullPrice;
            else $toPay = 100;
            echo '<form style="display:none" id="DotpayForm" name="do_platnosci" method="POST" action="https://ssl.dotpay.pl/test_payment/"> <input type="hidden" name="id" value="734129" /> <input type="hidden" name="opis" value="Opłata za pobyt w '.$request->link.'" /> <input type="hidden" name="control" value="'.$idReservation.'" /> <input type="hidden" name="amount" value="'.$toPay.'" /> <input type="hidden" name="typ" value="3" /> <input type="hidden" name="URL" value="'.route('reservations.fourthStepAfterDotpay', ['idAparment' => $request->id, 'idReservation' => $idReservation, 'status' => 'OK']).'"/> <input type="hidden" name="URLC" value="'.route('reservations.afterOnlinePaymentPOST').'"/></form><script>document.getElementById("DotpayForm").submit();</script>';
            exit();
        }
    }

    public function fourthStep($idReservation, $status = 1){

        $reservation = DB::table('reservations')->where('id', $idReservation)->get();

        $id = $reservation[0]->apartament_id;

        $apartament = Apartament::with(array('descriptions' => function($query)
        {
            $query->where('language_id', $this->language->id);
        }))->find($id);

        if(\App::environment('production')) {
            $reservationModel = new Reservation();
            $reservationModel->sendMail($idReservation, $this->language->id);
        }

        $servicesDetails = DB::table('reservation_additional_services')->where('id_reservation', $idReservation)->get();

        $availableServices = DB::table('additional_services')->where('id_apartament', $id)
            ->whereNotIn('id', DB::table('reservation_additional_services')->select('id_service')->where('id_reservation', $idReservation))
            ->get();

        return view('reservation.fourthStep', [
            'apartament' => $apartament,
            'reservation' => $reservation,
            'language' => $this->languageCode,
            'servicesDetails' => $servicesDetails ?? 0,
            'availableServices' => $availableServices ?? 0,
        ]);

    }

    public function fourthStepDotpay(Request $request){

        $id = $_GET['idAparment'];

        $apartament = Apartament::with(array('descriptions' => function($query)
        {
            $query->where('language_id', $this->language->id);
        }))->find($id);

        $reservation = DB::table('reservations')->where('id', $_GET['idReservation'])->get();

        if(\App::environment('production')) {
            $reservationModel = new Reservation();
            $reservationModel->sendMail($reservation[0]->apartament_id, $this->language->id);
        }

        $servicesDetails = DB::table('reservation_additional_services')->where('id_reservation', $_GET['idReservation'])->get();

        return view('reservation.fourthStep', [
            'apartament' => $apartament,
            'reservation' => $reservation,
            'language' => $this->languageCode,
            'servicesDetails' => $servicesDetails,
        ]);

    }

    public function AfterOnlinePayment (Request $request){
        echo "OK";

        if($request->operation_status == 'completed'){
            DB::table('reservations')->where('id', $request->control)->update(['payment_to_pay' => DB::raw("payment_to_pay - $request->operation_amount"), 'reservation_status' => 1, 'updated_at' => date("Y-m-d H:i:s")]);
        }

        if(\App::environment('production')) {
            $reservation = DB::table('reservations')->where('id', $request->control)->get();
            $reservationModel = new Reservation();
            $reservationModel->sendMail($reservation[0]->apartament_id, $this->language->id);
        }
        exit();
    }

    //Async send mail
    public function SendMail(Request $request){
        if(\App::environment('production')) {
            $request->reservationId;
            $reservationModel = new Reservation();
            $reservationModel->sendMail($request->reservationId, $this->language->id);
        }
        return response()->json(['res' => 'done']);
    }

    //Async cancel reservation
    public function CancelReservation(Request $request){

        DB::table('reservations')->where('id', $request->reservationId)->delete();

        return response()->json(['res' => 'done']);
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

    public function unavailable(Request $request){

        $apartament = DB::table('apartament_descriptions')
            ->leftJoin('apartaments','apartaments.id', '=', 'apartament_descriptions.apartament_id')
            ->where('apartaments.id', $request->id)
            ->where('language_id', 1)
            ->first();

        $region = $apartament->apartament_city;
        $arriveDate = $_GET['t-start'];
        $returnDate = $_GET['t-end'];

        $apartmentsSimilar = DB::table("apartaments")
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
                })
                ->distinct('apartaments.id'))
            ->where('language_id', $this->language->id)
            ->whereBetween('price_value', array($request->amount ?? 0, $request->amount2 ?? 10000))
            ->whereBetween('date_of_price', array($arriveDate, $returnDate))
            ->where(function($query) use ($region){
                if($region == NULL){
                    //
                }
                else{
                    $query->where('apartament_descriptions.apartament_name',$region)
                        ->orWhere('apartaments.apartament_city',$region);
                }
            })
            ->where('apartaments.apartament_persons', '>=', $request->dorosli)
            ->where('apartaments.apartament_kids', '>=', $request->dzieci)
            ->where('apartaments.id', '!=', $apartament->id)
            ->orderBy('min_price', 'ASC')
            ->groupBy('apartaments.id')
            ->limit(4)
            ->get();

        return view('reservation.apartment-unavailable', [
            'apartmentsSimilar' => $apartmentsSimilar,
            'apartament' => $apartament,
            'request' => $request,
        ]);
    }

    public function confirmation($idReservation){

        $reservation = DB::table('reservations')
            ->select('reservations.*', 'apartament_descriptions.apartament_name')
            ->leftJoin('apartament_descriptions', 'reservations.apartament_id', 'apartament_descriptions.apartament_id')
            ->where('reservations.id', $idReservation)
            ->where('language_id', 1)
            ->get();

        $id = $reservation[0]->apartament_id;

        $apartament = Apartament::with(array('descriptions' => function($query)
        {
            $query->where('language_id', $this->language->id);
        }))->find($id);

        $servicesDetails = DB::table('reservation_additional_services')->where('id_reservation', $idReservation)->get();

        $availableServices = DB::table('additional_services')->where('id_apartament', $id)
            ->whereNotIn('id', DB::table('reservation_additional_services')->select('id_service')->where('id_reservation', $idReservation))
            ->get();

        return view('reservation.confirmation', [
            'apartament' => $apartament,
            'reservation' => $reservation,
            'language' => $this->languageCode,
            'servicesDetails' => $servicesDetails,
            'availableServices' => $availableServices,
        ]);
    }

    public function printPdf($idReservation){

        $reservation = DB::table('reservations')
            ->select('reservations.*', 'apartament_descriptions.apartament_name')
            ->leftJoin('apartament_descriptions', 'reservations.apartament_id', 'apartament_descriptions.apartament_id')
            ->where('reservations.id', $idReservation)
            ->where('language_id', 1)
            ->get();

        $id = $reservation[0]->apartament_id;

        $apartament = Apartament::with(array('descriptions' => function($query)
        {
            $query->where('language_id', $this->language->id);
        }))->find($id);

        $servicesDetails = DB::table('reservation_additional_services')->where('id_reservation', $idReservation)->get();

        $availableServices = DB::table('additional_services')->where('id_apartament', $id)
            ->whereNotIn('id', DB::table('reservation_additional_services')->select('id_service')->where('id_reservation', $idReservation))
            ->get();
        $html = '';
        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape')->setWarnings(false);
        return $pdf->download('Potwierdzenie rezerwacji '.$reservation->apartament_name.'.pdf');
    }

    public function checkCoupon(Request $request){

        $coupon = DB::table('reservation_promotion_codes')
            ->select('*')
            ->where('promotion_code_code', $request->couponCode)
            ->first();

        if($coupon == null){
            return response()->json([
                'response' => false,
                'error' => 'Podano nieprawidłowy kod',
            ]);
        }
        else if($coupon->usage_times == 1 && $coupon->is_used == 1){
            return response()->json([
                'response' => false,
                'error' => 'Kupon został już wcześniej wykorzystany',
            ]);
        }
        else if($coupon->usage_times == 1){

            DB::table('reservation_promotion_codes')->where('id', $coupon->id)->update(['is_used' => 1]);
            $request->session()->put('couponValue', $coupon->promotion_code_value);

            return response()->json([
                'response' => true,
                'amount' => $coupon->promotion_code_value,
            ]);
        }
        else{
            $request->session()->put('couponValue', $coupon->promotion_code_value);
            return response()->json([
                'response' => true,
                'amount' => $coupon->promotion_code_value,
            ]);
        }
    }

}
