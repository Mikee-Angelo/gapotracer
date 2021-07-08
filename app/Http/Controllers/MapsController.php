<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Civilian; 
use App\Models\Establishment;

class MapsController extends Controller
{
    //
    public function index(){ 

        $establishment = Establishment::where('deleted_at', null)->get();

        return view('maps', [
            'establishment' => $establishment,
        ]);
    }
}
