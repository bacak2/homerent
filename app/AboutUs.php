<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class AboutUs extends Model
{
    public function getAllContactInfo(){
        return DB::table('contact_info')->select('key', 'value')->pluck('value', 'key');
    }

    public function getContactInboxEmail(){
        return DB::table('contact_info')->select('value')->where('key', 'form_contact_inbox_mail')->first()->value;
    }
}
