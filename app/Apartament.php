<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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

    public static function generateCalendar($apartament_id){



        //date_default_timezonde_set('Europe/Warsaw');

        //get prev & next month
        $calendar = Collection::make([]);

        for($i = 0; $i < 1; $i++) {
            $ym = date('Y-m', strtotime("+$i months", strtotime(date('Y-m'))));
            $timestamp = strtotime($ym, "-01");
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

                if ($today == $date) {
                    $week .= '<td class="today">' . $day;
                } else {
                    $week .= '<td>' . $day;
                }
                $week .= '</td>';

                // End of the week or end of the month
                if ($str % 7 == 6 || $day == $day_count) {

                    if ($day == $day_count) {
                        // Add empty cell
                        $week .= str_repeat('<td></td>', 6 - ($str % 7));
                    }

                    $weeks[] = '<tr>' . $week . '</tr>';

                    //Prepare for new week
                    $week = '';
                }
            }

            $calendar->push($weeks);
        }

        return $calendar;
    }

}
