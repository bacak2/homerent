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

class AboutUs extends Controller
{
    //Site language from database
    protected $language = 1;
    protected $geo_lat = '49.28789339999999';
    protected $geo_lon = '19.9524993';

    public function __construct()
    {
        $temp = \App::getLocale();
        $language = DB::table('languages')->select('id', 'language_code')->where('language_code',$temp)->first();
        $this->language = $language;
        if ($this->language->id == 1) setlocale(LC_TIME, "pl_PL");
        else setlocale(LC_TIME, "en_EN");
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
        return view('about-us.news-detail', ['newsId' => $newsId]);
    }

    public function guidebookDetail($guidebookLink){

        $guidebook = DB::table('guidebooks')
            ->where('guidebook_link', $guidebookLink)
            ->first();

        $tags = DB::table('guidebook_tag_pivots')
            ->where('guidebook_id', $guidebook->id)
            ->join('guidebook_tags','guidebook_tags.id', '=', 'guidebook_id')
            ->get();

        return view('guidebooks.detail', [
            'guidebook'=> $guidebook,
            'tags'=> $tags,
        ]);
    }

    public function contact(){
        return view('about-us.contact',[
            'language' => $this->language->language_code,
            'geo_lat' => $this->geo_lat,
            'geo_lon' => $this->geo_lon,
        ]);
    }

    public function faq($faqToShow){
        return view('about-us.contact',[
            'language' => $this->language->language_code,
            'geo_lat' => $this->geo_lat,
            'geo_lon' => $this->geo_lon,
            'faqToShow' => $faqToShow,
        ]);
    }

    public function report($idComment){

        $comment = DB::table('apartament_opinions')
            ->where('id', $idComment)
            ->first();

        $commentToReport = $comment->cons ?? $comment->pros;
        if(strlen($commentToReport) > 20) $commentToReport = substr($commentToReport, 0, 20)."...";
        else $commentToReport = substr($commentToReport, 0, 20);

        return view('about-us.contact',[
            'language' => $this->language->language_code,
            'geo_lat' => $this->geo_lat,
            'geo_lon' => $this->geo_lon,
            'idComment' => $idComment,
            'commentToReport' => $commentToReport,
        ]);
    }

    //Async send mail
    public function sendMailWithNews(Request $request){

        $emails = explode(',', str_replace(' ', '', $request->emails2));

        if(\App::environment('production')){
            foreach($emails as $email){
                Mail::send('includes.mail_send-to-friends', ['link'=>$request->link], function($message) use ($email){
                    $message->to($email)
                        ->subject(__('messages.mailSub4'));
                    $message->from('kontakt@visitzakopane.pl','Otozakopane');
                });
            }
        }

    }
    //Async send mail
    public function sendMailWithGuidebook(Request $request){

        $emails = explode(',', str_replace(' ', '', $request->emails2));

        if(\App::environment('production')){
            foreach($emails as $email){
                Mail::send('includes.mail_guidebook-send-to-friends', ['link'=>$request->link], function($message) use ($email){
                    $message->to($email)
                        ->subject(__('messages.mailSub5'));
                    $message->from('kontakt@visitzakopane.pl','Otozakopane');
                });
            }
        }

    }

    //sending mail from contact form
    public function SendMail(Request $request){

        if(\App::environment('production')) {
            Mail::send('includes.mail_contact-form', ['request'=>$request], function ($message) use ($request) {
                $message->to('krzysztof.baca@artplus.pl')
                    ->subject('Formularz kontaktowy');
                $message->from($request->contactEmail, 'Użytkownik serwisu Otozakopane');
            });
        }

        return redirect()->route("aboutUs.contact")->with('status', 'Zdjęcie dodano pomyślnie');

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

    public function printPdf($newsId){

        $news = DB::table('news')
            ->where('id', $newsId)
            ->first();

        $pdf = PDF::loadHTML('<div style="width: 100%; font-family: DejaVu Sans;"><div style="font-size: 12px">'.$news->news_content.'</div></div>')
            ->setPaper('a4', 'landscape')->setWarnings(false);

        return $pdf->download('Artykuł_'.$news->news_title.'.pdf');
    }

}