<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartament_description extends Model
{
    //
    public function apartament()
    {
        return $this->belongsTo('App\Apartament');
    }
}
