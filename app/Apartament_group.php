<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartament_group extends Model
{
    public function apartaments() {
	    return $this->hasMany('App\Apartament','group_id');
    }
   }
