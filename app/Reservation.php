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

    public function sendMail($reservations_id, $language){
        if(\App::environment('production')){
            $apartamentsDescription = DB::table('reservations')
                ->select('*', 'reservations.updated_at')
                ->join('apartaments','apartaments.id','=','reservations.apartament_id')
                ->join('apartament_descriptions','apartaments.id','=','apartament_descriptions.apartament_id')
                ->where('reservations.id', $reservations_id)
                ->where('language_id', $language)
                ->get();
            $apartamentsDescription = collect($apartamentsDescription)->map(function($x){ return (array) $x; })->toArray();

            if($apartamentsDescription[0]['email_sended'] != 1){
                Mail::send('includes.mail_pl', $apartamentsDescription[0], function($message) use ($apartamentsDescription){
                    $message->to($apartamentsDescription[0]['email'])
                        ->subject('Potwierdzenie rezerwacji');
                    $message->from('kontakt@visitzakopane.pl','Otozakopane');
                });

                DB::table('reservations')->where('id', $reservations_id)->update(['email_sended' => 1]);
            }
        }
    }

    //Checks availabity for each apartment in date
    public function checkAvailabity($id, $arrival, $departure){
        $availabity = DB::Table('apartaments')
            ->select('apartaments.id')
            ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
            ->where('apartaments.id','=',$id)
            ->whereNotIn('apartaments.id', function($query) use($arrival, $departure){
                $query->select('apartaments.id')
                    ->from('apartaments')
                    ->leftJoin('reservations', 'apartaments.id','=','reservations.apartament_id')
                    ->whereRaw('((reservation_arrive_date + INTERVAL 1 DAY between ? and ?) or (reservation_departure_date - INTERVAL 1 DAY between ? and ?))',[$arrival, $departure, $arrival, $departure]);
            })

            ->first();
        return $availabity;
    }
}
