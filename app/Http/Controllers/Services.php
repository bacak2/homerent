<?php
/**
 *@category Kontroler usług dodatkowych, aplikacji HOMERENT
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

class Services extends Controller
{
    //Site language from database
    protected $language = 1;
    protected $reservationId;

    public function __construct()
    {
        $temp = \App::getLocale();
        $language = DB::table('languages')->select('id', 'language_code')->where('language_code',$temp)->first();
        $this->language = $language;
    }

    public function firstStep($idAparment, $idReservation, $idService = 0){

        $id = $idAparment;

        $apartament = Apartament::with(array('descriptions' => function($query)
        {
            $query->where('language_id', $this->language->id);
        }))->find($id);

        $additionalServices = DB::table('reservation_additional_services')
            ->join('additional_service_descriptions','reservation_additional_services.service_type','=','additional_service_descriptions.service_type_id')
            ->where('id_reservation', $idReservation)
            ->where('language_id', $this->language->id)
            ->get();

        $availableServices = DB::table('additional_services')->where('id_apartament', $id)
            ->join('additional_service_descriptions','service_type_id','=','additional_services.service_type')
            ->whereNotIn('id', DB::table('reservation_additional_services')->select('id_service')->where('id_reservation', $idReservation))
            ->where('language_id', $this->language->id)
            ->get();

        //Generates an array of images gallery
        $images = DB::table('apartaments')
            ->select('apartament_photos.photo_link','apartaments.id')
            ->join('apartament_photos','apartaments.id','=','apartament_photos.apartament_id')
            ->where('apartament_id',$id)
            ->get();

        //suma wszystkich łóżek
        $beds = $apartament->apartament_single_beds+$apartament->apartament_double_beds;

        $cleaning = 50;
        $basicService = 50;

        $reservationDetails = DB::table('reservations')->where('id', $idReservation)->first();
        $servicesDetails = DB::table('reservation_additional_services')
            ->join('additional_service_descriptions','reservation_additional_services.service_type','=','additional_service_descriptions.service_type_id')
            ->where('id_reservation', $idReservation)
            ->where('language_id', $this->language->id)
            ->get();

        return view('services.firstStep', [
            'apartament' => $apartament,
            'images' => $images,
            'beds' => $beds,
            'przyjazdDb' => '2009-09-09',
            'powrotDb' => '2009-09-09',
            'ileNocy' =>4,
            'cleaning' => $cleaning,
            'basicService' => $basicService,
            'additionalServices' => $additionalServices,
            'availableServices' => $availableServices,
            'totalPrice' => 19,
            'kids' => 3,
            'persons' => 4,
            'idReservation' => $idReservation,
            'idService' => $idService,
            'reservationDetails' => $reservationDetails,
            'servicesDetails' => $servicesDetails,
        ]);

    }

    public function secondStep(Request $request){

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
        $servicesDetails = DB::table('reservation_additional_services')
            ->join('additional_service_descriptions','reservation_additional_services.service_type','=','additional_service_descriptions.service_type_id')
            ->where('id_reservation', session()->getId())
            ->where('language_id', $this->language->id)
            ->get();
        if($servicesDetails->count() > 0) DB::table('reservation_additional_services')->where('id_reservation', session()->getId())->delete();

        foreach($collectionOfServices as $service){
            foreach($service as $key => $value){
                if ($key == 0) continue;
                $serviceDetails = DB::table('additional_services')
                    ->select('name', 'price', 'with_options', 'service_type')
                    ->join('additional_service_descriptions','service_type_id','=','additional_services.service_type')
                    ->where('id', $key)
                    ->where('language_id', $this->language->id)
                    ->first();
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
                    'service_type' => $serviceDetails->service_type,
                    'price' => $price,
                    'nights' => $service[$key][2] ?? 0,
                    'adults' => $service[$key][1] ?? 0,
                    'with_options' => $withOptions,
                );
                DB::table('reservation_additional_services')->insert($servicesData);
            }
        }

        $servicesDetailsNowOrdered = DB::table('reservation_additional_services')
            ->join('additional_service_descriptions','reservation_additional_services.service_type','=','additional_service_descriptions.service_type_id')
            ->where('id_reservation', session()->getId())
            ->where('language_id', $this->language->id)
            ->get();
        $priceToPay = 0;

        foreach($servicesDetailsNowOrdered as $service){
            if($service->with_options == 0){
                $priceToPay += $service->price;
            }
            elseif($service->with_options == 2){
                $priceToPay += $service->price;
            }
            elseif($service->with_options == 3){
                echo 'test';
            }
        }

        $this->reservationId = $request->reservation_id;

        $servicesDetails = DB::table('reservation_additional_services')
            ->join('additional_service_descriptions','reservation_additional_services.service_type','=','additional_service_descriptions.service_type_id')
            ->where(function($q) {
                $q->where('id_reservation', $this->reservationId)
                    ->where('language_id', $this->language->id);
            })
            ->orWhere(function($q) {
                $q->where('id_reservation', session()->getId())
                    ->where('language_id', $this->language->id);
            })
            ->get();

        $apartament = Apartament::with(array('descriptions' => function($query)
        {
            $query->where('language_id', $this->language->id);
        }))->find($request->apartament_id);

        $reservationDetails = DB::table('reservations')->where('id', $request->reservation_id)->first();

        if(Auth::user()){
            $accountData = DB::table('users_account')->where('user_email', Auth::user()->email)->get();
        }
        else{
            $accountData = 0;
        }

        if($this->language->language_code == "PL"){
            $countries = DB::table('countries')->orderBy('pl')->pluck('pl', 'pl');
            $defaultCountry = 'Polska';
        }
        else{
            $countries = DB::table('countries')->orderBy('en')->pluck('en', 'en');
            $defaultCountry = 'Poland';
        }

        return view('services.secondStep', [
            'apartament' => $apartament,
            'servicesDetails' => $servicesDetails,
            'priceToPay' => $priceToPay,
            'reservationDetails' => $reservationDetails,
            'request' => $request,
            'accountData' => $accountData,
            'countries' => $countries,
            'defaultCountry' => $defaultCountry,
        ]);
    }

    public function thirdStep(Request $request)
    {
        //get priceToPay from request
        $toPay = Crypt::decrypt($request->priceToPay);

/*
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
            'created_at' => date('Y-m-d')
        ];

        if(isset($request->idActive) && is_numeric($request->idActive)){
            $userData = DB::table('users_account')->where('id', $request->idActive)->get();
            $userData = collect($userData)->map(function($x){ return (array) $x; })->toArray();
            $userData = $userData[0];
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
*/
        //change reservation_id of additional services to real id
        DB::table('reservation_additional_services')
            ->where('id_reservation', session()->getId())
            ->update(['id_reservation' => $request->reservation_id]);

        //add amount to total price and additional services price
        DB::table('reservations')
            ->where('id', $request->reservation_id)
            ->update(array(
                'payment_full_amount' => DB::raw('payment_full_amount +'.$toPay),
                'payment_to_pay' => DB::raw('payment_to_pay +'.$toPay),
                'payment_additional_services' => DB::raw('payment_additional_services +'.$toPay)
            ));
//return 0;
        if($request->payment_method == 2 || $request->payment_method == 4) {
            return redirect()->action(
                'Reservations@fourthStep', [
                    'idAparment' => $request->apartament_id,
                    'idReservation' => $request->reservation_id,
                    'status' => 2,
                ]
            );
        }

        //online payment
        else {
            $idReservation = $request->reservation_id;
            echo '<form style="display:none" id="DotpayForm" name="do_platnosci" method="POST" action="https://ssl.dotpay.pl/test_payment/"> <input type="hidden" name="id" value="734129" /> <input type="hidden" name="opis" value="Opłata za usługi dodatkowe" /> <input type="hidden" name="control" value="'.$idReservation.'" /> <input type="hidden" name="amount" value="'.$toPay.'" /> <input type="hidden" name="typ" value="3" /> <input type="hidden" name="URL" value="'.route('reservations.fourthStepAfterDotpay', ['idAparment' => $request->apartament_id, 'idReservation' => $idReservation, 'servicesAdded' => 'true']).'"/> <input type="hidden" name="URLC" value="'.route('reservations.afterOnlinePaymentPOST').'"/></form><script>document.getElementById("DotpayForm").submit();</script>';
            exit();
        }
    }

    public function fourthStep($idAparment, $idReservation, $status = 1){
        $id = $idAparment;

        $apartament = Apartament::with(array('descriptions' => function($query)
        {
            $query->where('language_id', $this->language->id);
        }))->find($id);

        if(\App::environment('production')) {
            $reservation = DB::table('reservations')->where('id', $idReservation)->get();
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
            'language' => $this->language->language_code,
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

        if(\App::environment('production')) {
            $reservation = DB::table('reservations')->where('id', $_GET['idReservation'])->get();
            $reservationModel = new Reservation();
            $reservationModel->sendMail($reservation[0]->apartament_id, $this->language->id);
        }

        $servicesDetails = DB::table('reservation_additional_services')->where('id_reservation', $_GET['idReservation'])->get();

        return view('reservation.fourthStep', [
            'apartament' => $apartament,
            'reservation' => $reservation,
            'language' => $this->language->language_code,
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
            $reservationModel->sendMail($reservation[0]->apartament_id, $reservation[0]->id, $this->language->id);
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
