<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establishment;
use App\Models\Civilian;
use App\Models\Vehicles;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $establishment = Establishment::where('deleted_at', null);
        $civilian = Civilian::where('deleted_at', null);
        $vehicle = Vehicles::where('deleted_at', null)->get();

        $suspected = Civilian::where([
            ['deleted_at', '=', null],
            ['status', '=',  1]
            ])->get();

        $confirmed = Civilian::where([
            ['deleted_at', '=', null],
            ['status', '>',  2]
            ])->get();
            
        $active = Civilian::where([
            ['deleted_at', '=', null],
            ['status', '=',  3]
            ])->get();
        
        $negative = Civilian::where([
            ['deleted_at', '=', null],
            ['status', '=',  2]
            ])->get();
        
        $recovered = Civilian::where([
            ['deleted_at', '=', null],
            ['status', '=',  4]
            ])->get();   
       
        $death = Civilian::where([
            ['deleted_at', '=', null],
            ['status', '=',  5]
            ])->get();   
        
        return view('home', [
            'establishment' => $establishment->get(),
            'civilian' => $civilian->get(), 
            'vehicle' => $vehicle, 
            'confirmed' => $confirmed,
            'suspected' => $suspected,
            'negative' => $negative,
            'active' => $active ,
            'recovered' => $recovered,
            'death' => $death,
        ]);
    }

    public function stats(){ 

        $suspected = Civilian::where([
            ['deleted_at', '=', null],
            ['status', '=',  1]
            ])->count();

        $confirmed = Civilian::where([
            ['deleted_at', '=', null],
            ['status', '>',  2]
            ])->count();
            
        $active = Civilian::where([
            ['deleted_at', '=', null],
            ['status', '=',  3]
            ])->count();
        
        $negative = Civilian::where([
            ['deleted_at', '=', null],
            ['status', '=',  2]
            ])->count();
        
        $recovered = Civilian::where([
            ['deleted_at', '=', null],
            ['status', '=',  4]
            ])->count();   
       
        $death = Civilian::where([
            ['deleted_at', '=', null],
            ['status', '=',  5]
            ])->count();   
        

        return response([
            'status' => true, 
            'confirmed' => $confirmed,
            'suspected' => $suspected,
            'negative' => $negative,
            'active' => $active ,
            'recovered' => $recovered,
            'death' => $death,
        ]);
    }
}
