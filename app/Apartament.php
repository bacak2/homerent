<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartament extends Model
{
    //
    public function descriptions(){
    	return $this->hasMany('App\Apartament_description');
    }

}
