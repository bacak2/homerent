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
use App;
use Illuminate\Support\Facades\Cookie;

class AboutUs extends Controller
{
    //Site language from database
    protected $language = 1;
    protected $contactEmail;

    public function __construct()
    {
        $temp = \App::getLocale();
        $language = DB::table('languages')->select('id', 'language_code')->where('language_code',$temp)->first();
        $this->language = $language;
        if ($this->language->id == 1) setlocale(LC_TIME, "pl_PL");
        else setlocale(LC_TIME, "en_EN");
        $aboutUs = new App\AboutUs();
        $this->contactEmail = $aboutUs->getContactInboxEmail();
    }

    public function index(){
        return view('about-us.index');
    }

    public function media(){
        $aboutUs = new App\AboutUs();
        $infos = $aboutUs->getAllContactInfo();

        $news = DB::table('news')
            ->where('language', $this->language->language_code)
            ->limit(3)
            ->get();

        $newsInMedia = DB::table('news')
            ->where('language', $this->language->language_code)
            ->limit(3)
            ->get();

        return view('about-us.media',[
            'infos' => $infos,
            'news' => $news,
            'newsInMedia' => $newsInMedia,
        ]);
    }

    public function news(){

        $news = DB::table('news')
            ->where('language', $this->language->language_code)
            ->limit(9)
            ->get();

        return view('about-us.news', ['news' => $news]);
    }

    public function newsDetail($newsId){

        $news = DB::table('news')
            ->where('news_id', $newsId)
            ->where('language', $this->language->language_code)
            ->first();

        $otherNews = DB::table('news')
            ->where('news_id', '!=', $newsId)
            ->where('language', $this->language->language_code)
            ->limit(4)
            ->get();

        return view('about-us.news-detail', [
            'news' => $news,
            'otherNews' => $otherNews,
        ]);
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

        $aboutUs = new App\AboutUs();
        $infos = $aboutUs->getAllContactInfo();

        return view('about-us.contact',[
            'language' => $this->language->language_code,
            'infos' => $infos,
        ]);
    }

    public function faq($faqToShow){

        $aboutUs = new App\AboutUs();
        $infos = $aboutUs->getAllContactInfo();

        return view('about-us.contact',[
            'language' => $this->language->language_code,
            'infos' => $infos,
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

        $aboutUs = new App\AboutUs();
        $infos = $aboutUs->getAllContactInfo();

        return view('about-us.contact',[
            'language' => $this->language->language_code,
            'infos' => $infos,
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
                    $message->from($this->contactEmail,'Otozakopane');
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
                    $message->from($this->contactEmail,'Otozakopane');
                });
            }
        }

    }

    //sending mail from contact form
    public function SendMail(Request $request){

        if(\App::environment('production')) {
            Mail::send('includes.mail_contact-form', ['request'=>$request], function ($message) use ($request) {
                if($request->file('file')  != null){
                    $destinationPath = 'uploads';
                    foreach($request->file('file') as $fileFromRequest){
                        $uploadedFile = $fileFromRequest->move($destinationPath, date('d-m-Y-H:m:s-').$fileFromRequest->getClientOriginalName());
                        $message->attach($uploadedFile);
                    }
                }
                $message->to($this->contactEmail)
                    ->subject('Formularz kontaktowy');
                $message->from($request->contactEmail, 'Użytkownik serwisu Otozakopane');
            });
        }

        return redirect()->route("aboutUs.contact")->with('status', __('messages.The email was sent successfully'));

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

    public function acceptCookies()
    {
        Cookie::queue('cookieAccepted', true, 129600);
        return response()->json(['res' => 'true']);
    }

}