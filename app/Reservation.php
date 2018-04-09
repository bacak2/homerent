<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mail;

class Reservation extends Model
{
    public function apartaments()
    {
    	return $this->belongsTo("App\Apartament",'apartament_id');
    }

    public function sendMail($apartament_id, $reservations_id, $language){

        $apartamentsDescription = DB::table('reservations')
            ->select('*')
            ->join('apartaments','apartaments.id','=','reservations.apartament_id')
            ->join('apartament_descriptions','apartaments.id','=','apartament_descriptions.apartament_id')
            ->where('reservations.id', $reservations_id)
            ->where('apartament_descriptions.apartament_id', $apartament_id)
            ->where('language_id', $language)
            ->get();
        $apartamentsDescription = collect($apartamentsDescription)->map(function($x){ return (array) $x; })->toArray();
        //dd($apartamentsDescription[0]['email']);
        Mail::send('includes.mail_pl', $apartamentsDescription[0], function($message) use ($apartamentsDescription){
            $message->to($apartamentsDescription[0]['email'])
                ->subject('Potwierdzenie rejestracji');
            $message->from('kontakt@visitzakopane.pl','Homerent');
        });
    }
}
