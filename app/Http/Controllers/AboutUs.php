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

    public function guidebookDetail($guidebookId){
        return view('guidebooks.index');
    }

    public function contact(){
        return view('about-us.contact',[
            'language' => $this->language->language_code,
            'geo_lat' => '49.28789339999999',
            'geo_lon' => '19.9524993',
        ]);
    }

    public function faq($faqToShow){
        return view('about-us.contact',[
            'language' => $this->language->language_code,
            'geo_lat' => '49.28789339999999',
            'geo_lon' => '19.9524993',
            'faqToShow' => $faqToShow,
        ]);
    }

    public function SendMail(Request $request){

        //dd($request);

        Mail::send('includes.mail_contact-form', [], function($message) use ($request){
            $message->to('krzysztof.baca@artplus.pl')
                ->subject('Formularz kontaktowy');
            $message->from('kontakt@visitzakopane.pl','Homerent');
        });

    }

    public function uploadFiles(Request $request) {
        $file = $request->file('importFile')->getPathName();
        $destinationPath = 'files/image/';
        $tmp_name = $request->file('importFile')->getClientOriginalName();
        //if (file_exists($destinationPath.$tmp_name)) return redirect()->route("import.showPictrues")->withInput($request->all());
        $moved = move_uploaded_file($file, $destinationPath.$tmp_name);

        return redirect()->route("import.showPictrues")->with('status', 'Zdjęcie dodano pomyślnie');
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