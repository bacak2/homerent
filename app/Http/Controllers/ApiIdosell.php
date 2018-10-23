<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Idosell;

class ApiIdosell extends Controller
{
    public function getReservation(){
        $idosell = new Idosell();
        return $idosell->getReservation();
    }
}
