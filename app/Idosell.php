<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idosell extends Model
{
    /*
        private $Baza = null;
        private $Domena;
        private $Language;
        *
         * Konstruktor
         *

    function __construct($Baza) {
        $this->Baza = $Baza;
    }
    */

    /**
     * @return requestBookings
     */
    public function getObject()
    {

        $address = 'https://client6127.idosell.com/api/objects/getAll/7/json';
        $request = array();
        $request['authenticate'] = array();
        $request['authenticate']['systemKey'] = "Gala1712!@";
        $request['authenticate']['systemLogin'] = "barpru666";
        $request['authenticate']['lang'] = 'eng';

        $response = $this->prepareCurl($address, $request);


        $decoded = json_decode(strstr($response, '{'), true);
        //echo "<pre>";
        //var_dump($decoded);
        //echo "</pre>";
        return $decoded;
    }

    function prepareCurl($address, $request){
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json;charset=UTF-8'
        );

        $request_json = json_encode($request);

        $curl = curl_init($address);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($curl, CURLINFO_HEADER_OUT, 1);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $request_json);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($curl);
        $status = curl_getinfo($curl);
        curl_close($curl);


        return $response;
    }



    /**
     * @param requestBookings $request
     * @return \PartnerIntegrationBundle\PartnerApi\OdkryjPolske\ApiSchema\getBookings
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }


    public function setReservation($DaneRezerwacji)
    {
        //var_dump($DaneRezerwacji);
        $address = 'https://client6127.idosell.com/api/reservations/add/10/json';


        $request = array();
        $request['authenticate'] = array();
        $request['authenticate']['systemKey'] = "Gala1712!@";
        $request['authenticate']['systemLogin'] = "barpru666";
        $request['authenticate']['lang'] = 'pol';
        $request['reservations'] = array();
        $request['reservations'][0] = array();
        $request['reservations'][0]['dateFrom'] = $DaneRezerwacji['reservation_date_p'];
        $request['reservations'][0]['dateTo'] = $DaneRezerwacji['reservation_date_k'];
        $request['reservations'][0]['price'] = $DaneRezerwacji['reservation_naleznosc'];
        //$request['reservations'][0]['clientId'] = 2;
        $request['reservations'][0]['apiNote'] = "apiNote";
        $request['reservations'][0]['clientNote'] = "clientNote";
        $request['reservations'][0]['externalNote'] = "externalNote";
        $request['reservations'][0]['internalNote'] = "internalNote";
        $request['reservations'][0]['sendEmailNotifications'] = 3;
        $request['reservations'][0]['status'] = 'confirmed';
        $request['reservations'][0]['reservationApiSynchronizationFlag'] = 'none';
        $request['reservations'][0]['packages'] = array();
        $request['reservations'][0]['packages'][0] = array();
        $request['reservations'][0]['packages'][0]['packageId'] = 1;
        $request['reservations'][0]['packages'][0]['price'] = $DaneRezerwacji['ceny_pobytu_by_day'];
        $request['reservations'][0]['items'] = array();
        $request['reservations'][0]['items'][0] = array();
        $request['reservations'][0]['items'][0]['objectItemId'] = $DaneRezerwacji['apartament_id_idosell']; // pokoj (trzecia przykladowa oferta)
        $request['reservations'][0]['items'][0]['capacity'] = $DaneRezerwacji['reservation_persons'];
        $request['reservations'][0]['items'][0]['price'] = $DaneRezerwacji['ceny_pobytu_by_day'];
        $request['reservations'][0]['currencyId'] = 1;
        $request['reservations'][0]['notify'] = true;
//var_dump($request['reservations'][0]);
//var_dump($request['reservations'][0]['packages']);
//var_dump($request['reservations'][0]['items']);

//$response = $client->__call('add', $request);
        $response = $this->prepareCurl($address, $request);


        $decoded = json_decode(strstr($response, '{'), true);
//var_dump($decoded);
        return $decoded;
    }

    public function getReservation()
    {

        $address = 'https://client6127.idosell.com/api/reservations/get/3/json';
        $request = array();
        $request['authenticate'] = array();
        $request['authenticate']['systemKey'] = "Gala1712!@";
        $request['authenticate']['systemLogin'] = "barpru666";
        $request['authenticate']['lang'] = 'eng';
        //$request['paramsSearch']['objectsIds'] = array();
        $request['paramsSearch']['modificationDateRange']['startDate'] = "2000-10-10 00:00";
        $request['paramsSearch']['modificationDateRange']['endDate'] = "2100-10-10 00:00";
        //$request['paramsSearch']['objectsIds'][0] = intval($id);

        $response = $this->prepareCurl($address, $request);


        $decoded = json_decode(strstr($response, '{'), true);

        return $decoded;
    }

    public function getReservationById($id)
    {

        $address = 'https://client6127.idosell.com/api/reservations/getByIds/3/json';
        $request = array();
        $request['authenticate'] = array();
        $request['authenticate']['systemKey'] = "Gala1712!@";
        $request['authenticate']['systemLogin'] = "barpru666";
        $request['authenticate']['lang'] = 'eng';
        //$request['paramsSearch']['objectsIds'] = array();
        //$request['paramsSearch']['modificationDateRange']['startDate'] = "2000-10-10 00:00";
        //$request['paramsSearch']['modificationDateRange']['endDate'] = "2100-10-10 00:00";
        //$request['paramsSearch']['objectsIds'][0] = intval($id);
        $request['ids'] = array($id);


        $response = $this->prepareCurl($address, $request);


        $decoded = json_decode(strstr($response, '{'), true);

        return $decoded;
    }


    public function getReservationByObjectId($id)
    {

        $address = 'https://client6127.idosell.com/api/reservations/get/3/json';
        $request = array();
        $request['authenticate'] = array();
        $request['authenticate']['systemKey'] = "Gala1712!@";
        $request['authenticate']['systemLogin'] = "barpru666";
        $request['authenticate']['lang'] = 'eng';
        //$request['paramsSearch']['objectsIds'] = array();
        //$request['paramsSearch']['modificationDateRange']['startDate'] = "2000-10-10 00:00";
        //$request['paramsSearch']['modificationDateRange']['endDate'] = "2100-10-10 00:00";
        $request['paramsSearch']['objectsIds'][0] = intval($id);

        $response = $this->prepareCurl($address, $request);


        $decoded = json_decode(strstr($response, '{'), true);

        return $decoded;
    }


    public function editReservation($id_reservations, $status){

        $address = 'https://client6127.idosell.com/api/reservations/edit/3/json';
        $request = array();
        $request['authenticate'] = array();
        $request['authenticate']['systemKey'] = "Gala1712!@";
        $request['authenticate']['systemLogin'] = "barpru666";
        $request['authenticate']['lang'] = 'eng';
        $request['reservations'] = array();
        $request['reservations'][0] = array();
        $request['reservations'][0]['id'] = $id_reservations;
        /*            $request['reservations'][0]['reservationApiSynchronizationFlag'] = 'none';
                    $request['reservations'][0]['dateFrom'] = "dateFrom";
                    $request['reservations'][0]['dateTo'] = "dateTo";
                    $request['reservations'][0]['price'] = 2.0;
                    $request['reservations'][0]['clientId'] = 3;
                    $request['reservations'][0]['clientNote'] = "clientNote";
                    $request['reservations'][0]['externalNote'] = "externalNote";
                    $request['reservations'][0]['apiNote'] = "apiNote";
                    $request['reservations'][0]['internalNote'] = "internalNote";
        */            $request['reservations'][0]['status'] = $status;

//Możliwe wartości: (unconfirmed, confirmed, paymentInProgress, accepted, inProgress, completed, canceled, withdrawn, waitingForPayment, invalidCardNumber)

        /*            $request['reservations'][0]['sendEmailNotification'] = 4;
                    $request['reservations'][0]['items'] = array();
                    $request['reservations'][0]['items'][0] = array();
                    $request['reservations'][0]['items'][0]['toDelete'] = true;
                    $request['reservations'][0]['items'][0]['objectItemId'] = 5;
                    $request['reservations'][0]['items'][0]['capacity'] = 6;
                    $request['reservations'][0]['items'][0]['price'] = 7.0;
                    $request['reservations'][0]['items'][0]['addons'] = array();
                    $request['reservations'][0]['items'][0]['addons'][0] = array();
                    $request['reservations'][0]['items'][0]['addons'][0]['toDelete'] = true;
                    $request['reservations'][0]['items'][0]['addons'][0]['addonId'] = 8;
                    $request['reservations'][0]['items'][0]['addons'][0]['persons'] = 9;
                    $request['reservations'][0]['items'][0]['addons'][0]['nights'] = 10;
                    $request['reservations'][0]['items'][0]['addons'][0]['price'] = 11.0;
                    $request['reservations'][0]['items'][0]['addons'][0]['vat'] = 12.0;
                    $request['reservations'][0]['notify'] = true;
        */
        $response = $this->prepareCurl($address, $request);


        $decoded = json_decode(strstr($response, '{'), true);
//var_dump($decoded['result']['reservations']);
        return $decoded;
    }

    public function rollbackReservation($id_reservations, $DaneRezerwacji){
        echo "<pre>";
        var_dump($DaneRezerwacji);
        echo "</pre>";
        $address = 'https://client6127.idosell.com/api/reservations/edit/3/json';
        $request = array();
        $request['authenticate'] = array();
        $request['authenticate']['systemKey'] = "Gala1712!@";
        $request['authenticate']['systemLogin'] = "barpru666";
        $request['authenticate']['lang'] = 'eng';

        $request['reservations'] = array();
        $request['reservations'][0] = array();
        $request['reservations'][0]['id'] = $id_reservations;
        $request['reservations'][0]['reservationApiSynchronizationFlag'] = 'none';
        $request['reservations'][0]['dateFrom'] = $DaneRezerwacji['reservation_date_p'];
        $request['reservations'][0]['dateTo'] = $DaneRezerwacji['reservation_date_k'];
        $request['reservations'][0]['price'] = $DaneRezerwacji['reservation_naleznosc'];
        //$request['reservations'][0]['clientId'] = 2;
        $request['reservations'][0]['apiNote'] = "apiNote";
        $request['reservations'][0]['clientNote'] = "clientNote";
        $request['reservations'][0]['externalNote'] = "externalNote";
        $request['reservations'][0]['internalNote'] = "internalNote";
        $request['reservations'][0]['sendEmailNotifications'] = 3;
        $request['reservations'][0]['status'] = $DaneRezerwacji['status_idosell'];
        $request['reservations'][0]['reservationApiSynchronizationFlag'] = 'none';
        $request['reservations'][0]['packages'] = array();
        $request['reservations'][0]['packages'][0] = array();
        $request['reservations'][0]['packages'][0]['packageId'] = 1;
        $request['reservations'][0]['packages'][0]['price'] = $DaneRezerwacji['ceny_pobytu_by_day'];
        $request['reservations'][0]['items'] = array();
        $request['reservations'][0]['items'][0] = array();
        $request['reservations'][0]['items'][0]['objectItemId'] = $DaneRezerwacji['apartament_id_idosell']; // pokoj (trzecia przykladowa oferta)
        $request['reservations'][0]['items'][0]['capacity'] = $DaneRezerwacji['reservation_persons'];
        $request['reservations'][0]['items'][0]['price'] = $DaneRezerwacji['ceny_pobytu_by_day'];
        $request['reservations'][0]['currencyId'] = 1;
        $request['reservations'][0]['notify'] = true;
        $response = $this->prepareCurl($address, $request);


        $decoded = json_decode(strstr($response, '{'), true);
//var_dump($decoded['result']['reservations']);
        return $decoded;
    }

    public function updateReservation($id_reservations, $DaneRezerwacji){
        echo "<pre>";
        var_dump($DaneRezerwacji);
        echo "</pre>";
        $address = 'https://client6127.idosell.com/api/reservations/edit/3/json';
        $request = array();
        $request['authenticate'] = array();
        $request['authenticate']['systemKey'] = "Gala1712!@";
        $request['authenticate']['systemLogin'] = "barpru666";
        $request['authenticate']['lang'] = 'eng';

        $request['reservations'] = array();
        $request['reservations'][0] = array();
        $request['reservations'][0]['id'] = $id_reservations;
        $request['reservations'][0]['reservationApiSynchronizationFlag'] = 'none';
        $request['reservations'][0]['dateFrom'] = $DaneRezerwacji['reservation_date_p'];
        $request['reservations'][0]['dateTo'] = $DaneRezerwacji['reservation_date_k'];
        $request['reservations'][0]['price'] = $DaneRezerwacji['reservation_naleznosc'];
        //$request['reservations'][0]['clientId'] = 2;
        $request['reservations'][0]['apiNote'] = "apiNote";
        $request['reservations'][0]['clientNote'] = "clientNote";
        $request['reservations'][0]['externalNote'] = "externalNote";
        $request['reservations'][0]['internalNote'] = "internalNote";
        $request['reservations'][0]['sendEmailNotifications'] = 3;
        $request['reservations'][0]['status'] = $DaneRezerwacji['status_idosell'];
        $request['reservations'][0]['reservationApiSynchronizationFlag'] = 'none';
        $request['reservations'][0]['packages'] = array();
        $request['reservations'][0]['packages'][0] = array();
        $request['reservations'][0]['packages'][0]['packageId'] = 1;
        $request['reservations'][0]['packages'][0]['price'] = $DaneRezerwacji['ceny_pobytu_by_day'];
        $request['reservations'][0]['items'] = array();
        $request['reservations'][0]['items'][0] = array();
        $request['reservations'][0]['items'][0]['objectItemId'] = $DaneRezerwacji['apartament_id_idosell']; // pokoj (trzecia przykladowa oferta)
        $request['reservations'][0]['items'][0]['capacity'] = $DaneRezerwacji['ilosc_osob']['p'];
        $request['reservations'][0]['items'][0]['price'] = $DaneRezerwacji['ceny_pobytu_by_day'];
        $request['reservations'][0]['currencyId'] = 1;
        $request['reservations'][0]['notify'] = true;
        $response = $this->prepareCurl($address, $request);


        $decoded = json_decode(strstr($response, '{'), true);
//var_dump($decoded['result']['reservations']);
        return $decoded;
    }


    public function syncReservation(){
        $address = 'https://client6127.idosell.com/api/reservations/get/3/json';
        $request = array();
        $request['authenticate'] = array();
        $request['authenticate']['systemKey'] = "Gala1712!@";
        $request['authenticate']['systemLogin'] = "barpru666";
        $request['authenticate']['lang'] = 'eng';
        //$request['paramsSearch']['objectsIds'] = array();
        //$request['paramsSearch']['modificationDateRange']['startDate'] = "2000-10-10 00:00";
        //$request['paramsSearch']['modificationDateRange']['endDate'] = "2100-10-10 00:00";
        //$request['paramsSearch']['objectsIds'][0] = intval($id);
        $request['paramsSearch']['status'] = "canceled";
//Możliwe wartości: (unconfirmed, confirmed, paymentInProgress, accepted, inProgress, completed, canceled, withdrawn, waitingForPayment, invalidCardNumber)
        $response = $this->prepareCurl($address, $request);


        $decoded = json_decode(strstr($response, '{'), true);

        return $decoded;
    }

    public function get24hReservation(){
        $date = date('Y-m-d H:i');
        $start_date = date('Y-m-d H:i', strtotime($date . ' -1 day'));
        $stop_date = date('Y-m-d H:i', strtotime($date . ' +1 day'));

        $address = 'https://client6127.idosell.com/api/reservations/get/3/json';
        $request = array();
        $request['authenticate'] = array();
        $request['authenticate']['systemKey'] = "Gala1712!@";
        $request['authenticate']['systemLogin'] = "barpru666";
        $request['authenticate']['lang'] = 'eng';
        //$request['paramsSearch']['objectsIds'] = array();
        $request['paramsSearch']['addDateRange']['startDate'] = $start_date;
        $request['paramsSearch']['addDateRange']['endDate'] = $stop_date;
        //$request['paramsSearch']['objectsIds'][0] = intval($id);
        //$request['paramsSearch']['status'] = "canceled";
//Możliwe wartości: (unconfirmed, confirmed, paymentInProgress, accepted, inProgress, completed, canceled, withdrawn, waitingForPayment, invalidCardNumber)
        $response = $this->prepareCurl($address, $request);

        $decoded = json_decode(strstr($response, '{'), true);

        return $decoded;
    }

    public function saveToVisit($Values){

        //sprawdz czy rezerwacja już jest
        $isset = $this->Baza->GetValue("SELECT reservation_id_idosell FROM visit_reservations WHERE reservation_id_idosell = {$Values['id']}");

        if(!$isset){ //czy jest już rezerwacja w bazie

            //$DaneRezerwacji['apartament_id_idosell'] = $Values;
            $DaneRezerwacji['reservation_id_idosell'] = $Values['id'];
            $DaneRezerwacji['apartament_id_idosell'] = $Values['items'][0]['itemId'];

            $Rezerwacje_Helper = new Rezerwacje_Helper();
            $numer = $Rezerwacje_Helper->GenerujNumerRezerwacji($this->Baza);
            $DaneRezerwacji['reservation_number'] = $numer;

            $DaneRezerwacji['reservation_date_p'] = $Values['reservationDetails']['dateFrom'];
            $DaneRezerwacji['reservation_date_k'] = $Values['reservationDetails']['dateTo'];

            $Dzis = date("Y-m-d H:i:s");
            $DaneRezerwacji['reservation_data'] = $Dzis;

            $DaneRezerwacji['reservation_persons'] = $Values['items'][0]['numberOfGuests'];
            $DaneRezerwacji['reservation_naleznosc'] = $Values['reservationDetails']['price'];
            $DaneRezerwacji['reservation_zaliczka'] = $Values['reservationDetails']['advance'];
            $DaneRezerwacji['reservation_paid'] = 0;

            $DaneRezerwacji['reservation_data_waznosci'] = Rezerwacje_Helper::WyznaczDateWaznosci($this->Baza, false);
            $DaneRezerwacji['reservation_data_waznosci_2'] = date("Y-m-d H:i:s", strtotime($Dzis."+3 days"));

            if($Values['reservationDetails']['status'] == "accepted"){
                $DaneRezerwacji['reservation_status'] = 8;
            }elseif($Values['reservationDetails']['status'] == "unconfirmed"){
                $DaneRezerwacji['reservation_status'] = 1;
            }else{
                $DaneRezerwacji['reservation_status'] = 1;
            }


            $DaneRezerwacji['reservation_waluta'] = $Values['reservationDetails']['currency'];
            $DaneRezerwacji['apartament_id'] = (int)$this->Baza->GetValue("SELECT apartament_id FROM visit_apartaments WHERE apartament_id_idosell = ".$DaneRezerwacji['apartament_id_idosell']."");

            $DaneRezerwacji['from_portal'] = "idosell";
            $DaneRezerwacji['reservation_services'] = 65;


            $Zapytanie = $this->Baza->PrepareInsert("visit_reservations", $DaneRezerwacji);
            $this->Baza->Query($Zapytanie);
            $ReservationID = $this->Baza->GetLastInsertId();

            echo "Id rezer: ".$ReservationID."<br>";

            //var_dump($DaneRezerwacji);
        }else{

            // Jesli rezerwacjajest juz w visit
            $Data_reservation = $this->Baza->GetResultAsArray("SELECT * FROM visit_reservations WHERE reservation_services = 65 AND reservation_id_idosell = {$Values['id']}");

            //var_dump($Data_reservation);
            if($Data_reservation != false){ //istnieje

                //var_dump($Values);
                //var_dump($Values['items'][0]);
                //echo $Values['reservationDetails']['status'];
                //echo $Values['id']." - ". $status."<br>";

//Jesli zaakceptowana
                if($Values['reservationDetails']['status'] == 'accepted' || $Values['reservationDetails']['status'] == 'completed' || $Values['reservationDetails']['status'] == 'confirmed' ){
                    $this->Baza->Query("UPDATE visit_reservations SET status = 8 WHERE id = '{$Data_reservation['reservation_id']}'"); //zmien status
                }
//Jesli anulowana
                if($Values['reservationDetails']['status'] == 'canceled'){
                    $this->Baza->Query("UPDATE visit_reservations SET status = 5 WHERE id = '{$Data_reservation['reservation_id']}'"); //zmien status
                }
            }
        }
    }

    public function testbase(){
        $Reserv = $this->Baza->GetResultAsArray("SELECT * FROM visit_reservations WHERE reservation_id = 25121");
        var_dump($Reserv);
    }

}
