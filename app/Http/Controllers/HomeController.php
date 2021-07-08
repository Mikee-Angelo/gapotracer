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

        return view('home', [
            'establishment' => $establishment->get(),
            'civilian' => $civilian->get(), 
            'vehicle' => $vehicle, 
            'confirmed' => $civilian->where('status', '>', 2)->count(),
            'suspected' => $civilian->where('status', 1)->count(),
            'negative' => $civilian->where('status', 2)->count(),
            'active' => $civilian->where('status', 3)->count(),
            'recovered' => $civilian->where('status', 4)->count(),
            'death' => $civilian->where('status', 5)->count(),
        ]);
    }
}
