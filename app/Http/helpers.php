<?php
/**
 * Created by PhpStorm.
 * User: adminartplus
 * Date: 26.09.18
 * Time: 09:33
 */

use Illuminate\Support\Facades\DB;

function titleDays(){
    switch(App::getLocale()){
        case 'en': return "['Mon', 'Tue', 'Wen', 'Thu', 'Fri', 'Sat', 'Sun']"; break;
        case 'pl': default: return "['Pn', 'Wt', 'Śr', 'Cz', 'Pt', 'Sb', 'Nd']"; break;
    }
}

function titleMonths(){
    switch(App::getLocale()){
        case 'en': return "['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']"; break;
        case 'pl': default: return "['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień']"; break;
    }
}

function countAllApartments(){
    return DB::table('apartaments')->count();
}

function countAllReservations(){
    return DB::table('reservations')->count();
}

function countAllOpinions(){
    return DB::table('apartament_opinions')->count();
}

function countLastReservationDiff($lastReservationDate){
    $date1 = new DateTime($lastReservationDate);
    $date2 = new DateTime('now');
    $diff = $date2->diff($date1);
    $hours = $diff->h;
    return $hours + ($diff->days*24);
}

function getContactEmail(){
    return DB::table('contact_infos')->select('contact_email')->first()->contact_email;
}

function getContactPerson(){
    return DB::table('contact_infos')->select('contact_person')->first()->contact_person;
}

function getContactPersonEmail(){
    return DB::table('contact_infos')->select('contact_person_email')->first()->contact_person_email;
}

function getContactPhone(){
    return DB::table('contact_infos')->select('first_phone')->first()->first_phone;
}

function getContactSecondPhone(){
    return DB::table('contact_infos')->select('second_phone')->first()->second_phone;
}