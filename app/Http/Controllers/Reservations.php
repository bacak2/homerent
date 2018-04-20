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
use GuzzleHttp\Client;

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
        $request->przyjazd = $przyjazdDb = date("Y-m-d", strtotime($przyjazdDb));
        $powrotDb = explode(" ", $request->powrot);
        $powrotDb = $powrotDb[1] ?? $powrotDb[0];
        $request->powrot = $powrotDb = date("Y-m-d", strtotime($powrotDb));
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

        $cleaning = 51;
        $basicService = 50;
        $request->fullPrice = $totalPrice->total_price + $request->servicesPrice + $cleaning + $basicService;

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
        ]);

    }

    public function secondStep(Request $request){

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

        return view('reservation.secondStep', [
            'apartament' => $apartament,
            'images' => $images,
            'priceFrom' => $priceFrom,
            'beds' => $beds,
            'request' => $request,
            'accountData' => $accountData,
        ]);

    }

    public function thirdStep(Request $request)
    {
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
        $idReservation = DB::table('reservations')->insertGetId($dataSet);

        if($request->payment_method == 2 || $request->payment_method == 4) {
            return redirect()->action(
                'Reservations@fourthStep', ['idAparment' => $request->id, 'idReservation' => $idReservation]
            );
        }

        //online payment
        else {
            if ($request->payment_method == 1) $toPay = $request->fullPrice;
            else $toPay = 100;

            echo '<form style="display:none" id="DotpayForm" name="do_platnosci" method="POST" action="https://ssl.dotpay.pl/test_payment/"> <input type="hidden" name="id" value="734129" /> <input type="hidden" name="opis" value="Opłata za pobyt w '.$request->link.'" /> <input type="hidden" name="control" value="" /> <input type="hidden" name="amount" value="'.$toPay.'" /> <input type="hidden" name="typ" value="3" /> <input type="hidden" name="URL" value="'.route('reservations.onlinePaymentSuccess', ['idAparment' => $request->id, 'idReservation' => $idReservation]).'" /> <input type="hidden" name="URLC" value="'.route('reservations.onlinePaymentFailure', ['idAparment' => $request->id, 'idReservation' => $idReservation]).'"/> <input type="submit" name="dalej" value="zapłać teraz" /> </form><script>document.getElementById("DotpayForm").submit();</script>';
            exit();
        }
    }

    public function fourthStep($idAparment, $idReservation){

        $id = $idAparment;

        $apartament = Apartament::with(array('descriptions' => function($query)
        {
            $query->where('language_id', $this->language->id);
        }))->find($id);

        $reservation = DB::table('reservations')->where('id', $idReservation)->get();

        //$reservationModel = new Reservation();
        //$reservationModel->sendMail($idAparment, $idReservation, $this->language->id);

        return view('reservation.fourthStep', [
            'apartament' => $apartament,
            'reservation' => $reservation,
            'language' => $this->language->language_code,
        ]);

    }

    public function OnlinePaymentSuccess($idAparment, $idReservation){

        DB::table('reservations')->where('id', $idReservation)->update(['reservation_status' => 1, 'updated_at' => date("Y-m-d H:i:s")]);

        return redirect()->action(
            'Reservations@fourthStep', ['idAparment' => $idAparment, 'idReservation' => $idReservation]
        );

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
