<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function apartaments()
    {
    	return $this->belongsTo("App\Apartament",'apartament_id');
    }
}
