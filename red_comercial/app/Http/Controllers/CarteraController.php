<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarteraController extends Controller
{
    public function index(Request $request){
        
        $cartera = Cartera::all()->where('iduser', 'like', auth()->id());

        return $cartera;
    }
}
