<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartament extends Model
{
    //Pobiera podstawowe dane pojedynczego apartamentu o okreslonym ID
    public static function getApartamentInfo($id) {

        return Apartament::where('id', $id)->first();
    }





    
}
