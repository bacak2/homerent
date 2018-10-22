<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use DB;
use DateTime;

class Apartament extends Model
{
    //
    public function descriptions(){
    	return $this->hasMany('App\Apartament_description');
    }


    public function reservations()
    {
    	return $this->hasMany('App\Reservation');
    }

    public function groups()
    {
        return $this->belongsTo('App\Apartament_group');
    }

    public function generateCalendar($apartament_id){

        $reserveds = DB::table('reservations')->select('reservation_arrive_date', 'reservation_departure_date')->where('apartament_id', $apartament_id)->where('reservation_status', 1)->get();
        $preBookings = DB::table('reservations')->select('reservation_arrive_date', 'reservation_departure_date')->where('apartament_id', $apartament_id)->where('reservation_status', 0)->get();

        $reservedDates = array();

        for($i = 0; count($reserveds) > $i; $i++) {

            $arriveDate = new DateTime($reserveds[$i]->reservation_arrive_date);
            $departureDate = new DateTime($reserveds[$i]->reservation_departure_date);

            for ($arriveDate; $arriveDate <= $departureDate; $arriveDate = $arriveDate->modify("+1 days")) {
                array_push($reservedDates, $arriveDate->format('Y-m-j'));
            }
        }

        $preBookingDates = array();

        for($i = 0; count($preBookings) > $i; $i++) {

            $arriveDate = new DateTime($preBookings[$i]->reservation_arrive_date);
            $departureDate = new DateTime($preBookings[$i]->reservation_departure_date);

            for ($arriveDate; $arriveDate <= $departureDate; $arriveDate = $arriveDate->modify("+1 days")) {
                array_push($preBookingDates, $arriveDate->format('Y-m-j'));
            }

        }

        //date_default_timezonde_set('Europe/Warsaw');

        //get prev & next month
        $calendar = Collection::make([]);

        for($i = 0; $i < 12; $i++) {
            $ym = date('Y-m', strtotime("+$i months", strtotime(date('Y-m'))));
            $timestamp = strtotime($ym, "-1001");
            if ($timestamp === false) {
                $timestamp = time();
            }
            // Today
            $today = date('Y-m-d', time());

            //for h3 title
            $html_title = date('Y / m', $timestamp);

            //next and prev month link
            $prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp) - 1, 1, date('Y', $timestamp)));
            $next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp) + 1, 1, date('Y', $timestamp)));

            //number of days in the month
            $day_count = date('t', $timestamp);

            // 0:sun, 1:mon...
            $str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
            if ($str == 0) $str = 6;
            else {
                $str = $str - 1;
            }
            //create calendar
            $weeks = array();
            $week = '';

            //Add empty cell
            $week .= str_repeat('<td></td>', $str);

            for ($day = 1; $day <= $day_count; $day++, $str++) {
                $date = $ym . '-' . $day;

                if(in_array($date, $reservedDates)) {
                    $week .= '<td class="reserved">' . $day;
                }
                elseif(in_array($date, $preBookingDates)){
                    $week .= '<td class="pre-booking">' . $day;
                }
                else {
                    $week .= '<td class="available">' . $day;
                }
                $week .= '</td>';

                // End of the week or end of the month
                if ($str % 7 == 6 || $day == $day_count) {

                    if ($day == $day_count) {
                        // Add empty cell
                        $week .= str_repeat('<td></td>', 6 - ($str % 7));
                    }

                    $weeks[] = '<tr class="calendar-tbody">' . $week . '</tr>';

                    //Prepare for new week
                    $week = '';
                }
            }

            $calendar->push($weeks);
        }

        return $calendar;
    }

    public function generateReservedDates($apartament_id)
    {
        $reservedDates = '';

        $reserveds = DB::table('reservations')
            ->select('reservation_arrive_date', 'reservation_departure_date')
            ->where('apartament_id', $apartament_id)
            ->where('reservation_status', 1)
            ->whereRaw('reservation_arrive_date > NOW() - INTERVAL 1 DAY')
            ->get();

        for ($i = 0; count($reserveds) > $i; $i++) {

            $arriveDate = new DateTime($reserveds[$i]->reservation_arrive_date);
            $departureDate = new DateTime($reserveds[$i]->reservation_departure_date);

            for ($arriveDate; $arriveDate <= $departureDate; $arriveDate = $arriveDate->modify("+1 days")) {
                $reservedDates = $reservedDates."'".$arriveDate->format('Y-m-d')."' : '',";
            }
        }

        return $reservedDates;
    }

    public function generatePreReservedDates($apartament_id)
    {
        $reservedDates = '';

        $prebookings = DB::table('reservations')
            ->select('reservation_arrive_date', 'reservation_departure_date')
            ->where('apartament_id', $apartament_id)
            ->where('reservation_status', 0)
            ->whereRaw('reservation_arrive_date > NOW() - INTERVAL 1 DAY')
            ->get();

        for ($i = 0; count($prebookings) > $i; $i++) {

            $arriveDate = new DateTime($prebookings[$i]->reservation_arrive_date);
            $departureDate = new DateTime($prebookings[$i]->reservation_departure_date);

            for ($arriveDate; $arriveDate <= $departureDate; $arriveDate = $arriveDate->modify("+1 days")) {
                $reservedDates = $reservedDates."'".$arriveDate->format('Y-m-d')."' : '',";
            }
        }

        return $reservedDates;
    }

}
