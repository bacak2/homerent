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

class AboutUs extends Controller
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
        return view('about-us.index');
    }

    public function media(){
        return view('about-us.media');
    }

    public function news(){
        return view('about-us.news');
    }

    public function newsDetail($newsId){
        return view('about-us.news-detail');
    }

    public function contact(){
        return view('about-us.contact',[
            'language' => $this->language->language_code,
            'geo_lat' => '49.28789339999999',
            'geo_lon' => '19.9524993',
        ]);
    }

    public function getDownload($name, $extension)
    {

        $file = public_path()."/files_to_download/".$name.".".$extension;

        if(file_exists($file)){
            $headers = array(
                'Content-Type: application/pdf',
            );

            return response()->download($file, $name.".".$extension, $headers);
        }

        else url()->previous();

    }

}