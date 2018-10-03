<?php
/**
 * Created by PhpStorm.
 * User: adminartplus
 * Date: 29.05.18
 * Time: 09:02
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Session;
use Mail;
use Barryvdh\DomPDF\Facade as PDF;

class Guidebooks extends Controller
{
    //Site language from database
    protected $language = 1;

    public function __construct()
    {
        $temp = \App::getLocale();
        $language = DB::table('languages')->select('id', 'language_code')->where('language_code',$temp)->first();
        $this->language = $language;
    }

    public function index(){

        $firstCityMinPrice = DB::table('apartaments')
            ->join('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
            ->where('apartament_city', 'Zakopane')
            ->min('price_value');

        $secondCityMinPrice = DB::table('apartaments')
            ->join('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
            ->where('apartament_city', 'Kościelisko')
            ->min('price_value');

        $thirdCityMinPrice = DB::table('apartaments')
            ->join('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
            ->where('apartament_city', 'Witów')
            ->min('price_value');

        return view('guidebooks.index', [
            'firstCityMinPrice'=> $firstCityMinPrice ?? 99,
            'secondCityMinPrice'=> $secondCityMinPrice ?? 99,
            'thirdCityMinPrice'=> $thirdCityMinPrice ?? 99,
        ]);
    }

    public function detail($guidebookLink){

        $guidebook = DB::table('guidebooks')
            ->where('guidebook_link', $guidebookLink)
            ->where('guidebook_language_id', $this->language->id)
            ->first();

        $tags = DB::table('guidebook_tag_pivots')
            ->where('guidebook_id', $guidebook->id)
            ->join('guidebook_tags','guidebook_tags.id', '=', 'tag_id')
            ->get();

        $relatedGuidebooks = DB::table('guidebooks')
            ->where('guidebook_group', $guidebook->guidebook_group)
            ->where('guidebooks.id', '!=', $guidebook->id)
            ->where('guidebook_language_id', $this->language->id)
            ->get();

        $apartmentsNearby = DB::table('apartaments')
            ->selectRaw('*, sub.opinionAmount, sub.ratingAvg, apartaments.id, MIN(price_value) AS min_price')
            ->join('apartament_descriptions','apartaments.id', '=', 'apartament_descriptions.apartament_id')
            ->leftjoin(DB::raw('(select id_apartament, count(id_apartament) as opinionAmount, avg(total_rating) as ratingAvg from `reservations`
                cross join `apartament_opinions` on `reservations`.`id` = `apartament_opinions`.`id_reservation`  group by id_apartament) sub
            '), 'sub.id_apartament', '=', 'apartaments.id')
            ->leftjoin(DB::raw('(select apartament_id, reservations.created_at as lastReservationDate from `apartaments`
                right join `reservations` on `apartaments`.`id` = `reservations`.`id`  group by apartament_id) lastReservation
            '), 'lastReservation.apartament_id', '=', 'apartaments.id')
            ->join('languages', function($join) {
                $join->on('apartament_descriptions.language_id','=','languages.id')
                    ->where('languages.id', $this->language->id);
            })
            ->leftJoin('apartament_prices','apartaments.id', '=', 'apartament_prices.apartament_id')
            ->where('apartament_city', $guidebook->guidebook_city)
            ->groupBy('apartaments.id')
            ->limit(4)
            ->get();

        if(\App::environment('production')){
            $url = 'http://api.openweathermap.org/data/2.5/find?q='.$guidebook->guidebook_city.',pl&mode=json&appid=3714b92fc50570a087b4018fe0376aa3';
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            $data = curl_exec($curl);
            curl_close($curl);

            $weather = json_decode($data);
            $weather = $weather->list[0];
            $weather->rain = (array) $weather->rain;

            $temperature = round($weather->main->temp-273.15, 1).' °C';

            switch($weather->weather[0]->main){
                case 'Clouds': $icon = "Cloud_30"; break;
                case 'Rain': $icon = "Rain_30"; break;
                case 'Snow': $icon = "Snow_30"; break;
                case 'Clear':
                default: $icon = "Sun 2_30"; break;
            }
        }else {
            $temperature = 10;
            $icon = "Rain_30";
        }
        $icon = asset("images/guidebooks/$icon.png");

        return view('guidebooks.detail', [
            'guidebook'=> $guidebook,
            'tags'=> $tags,
            'relatedGuidebooks'=> $relatedGuidebooks,
            'apartmentsNearby'=> $apartmentsNearby,
            'temperature'=> $temperature,
            'icon'=> $icon,
        ]);
    }

    public function tag($guidebookTagLink){

        $tag = DB::table('guidebook_tags')
            ->where('tag_link', $guidebookTagLink)
            ->first();

        $guidebooksWithSameTag = DB::table('guidebook_tag_pivots')
            ->where('tag_id', $tag->id)
            ->join('guidebooks','guidebooks.id', '=', 'guidebook_id')
            ->get();

        $relatedTags = DB::table('guidebook_tags')
            ->where('tag_group', $tag->tag_group)
            ->where('tag_link', '!=', $guidebookTagLink)
            ->get();

        return view('guidebooks.tag', [
            'tag'=> $tag,
            'tagCity'=> $tag->tag_city ?? '',
            'guidebooksWithSameTag'=> $guidebooksWithSameTag,
            'relatedTags'=> $relatedTags,
        ]);
    }

    public function printPdf($guidebookLink){

        $guidebook = DB::table('guidebooks')
            ->where('guidebook_link', $guidebookLink)
            ->first();

        $pdf = PDF::loadHTML('<div style="width: 100%; font-family: DejaVu Sans;"><div style="font-size: 14px">'.$guidebook->guidebook_header.'</div><br><br><div style="font-size: 12px">'.$guidebook->guidebook_content.'</div></div>')
            ->setPaper('a4', 'landscape')->setWarnings(false);

        return $pdf->download('Przewodnik_'.$guidebookLink.'.pdf');
    }

}