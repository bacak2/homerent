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
                        ->subject(__('messages.mailSub1'));
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

    //Script launch only once when page will launch on prod
    public function syncReservationVisit(){
        $reservations = DB::connection('mysql')
            ->table('visit_reservations')
            ->select('otozakopane_id', 'visit_reservations.*')
            ->rightJoin('visitzakopane_apartaments_ids', 'visit_reservations.apartament_id','=','visitzakopane_id')
            ->where('reservation_deleted', 0)
            ->where('reservation_status', '<>', 5)
            ->get();

        foreach($reservations as $reservation){
            try{
                switch($reservation->reservation_status){
                    case 2: case 3: case 4: case 6: case 7: case 8: case 9: case 10: case 12: case 13: $resStatus = 1; break;
                    case 1:default: $resStatus = 0; break;
                }

                $dStart = new \DateTime($reservation->reservation_date_p);
                $dEnd  = new \DateTime($reservation->reservation_date_k);
                $dDiff = $dStart->diff($dEnd);

                $reservationData =[
                    'apartament_id' => $reservation->otozakopane_id,
                    'user_id' => 0,
                    'reservation_arrive_date' => $reservation->reservation_date_p,
                    'reservation_departure_date' => $reservation->reservation_date_k,
                    'reservation_persons' => $reservation->reservation_persons,
                    'reservation_kids' => $reservation->reservation_kids,
                    'reservation_nights' => $dDiff->days,
                    'reservation_additional_message' => '',
                    'reservation_arrive_time' => '12:00',
                    'reservation_advance' => $reservation->reservation_zaliczka,
                    'reservation_payment' => 1,
                    'payment_full_amount' => $reservation->reservation_naleznosc,
                    'payment_to_pay' => $reservation->reservation_naleznosc,
                    'payment_all_nights' => $reservation->reservation_naleznosc,
                    'payment_final_cleaning' => 0,
                    'payment_additional_services' => 0,
                    'payment_basic_service' => 0,
                    'reservation_status' => $resStatus,
                    'visit_reservation_id' => $reservation->reservation_id,
                    'created_at' => $reservation->reservation_data
                ];

                DB::connection('mysql')->table('reservations')->insert($reservationData);

            }catch(\Exception $e){
                Log::error($e->getMessage());
            }
        }
    }
}
