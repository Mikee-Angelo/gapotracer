<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establishment;
use App\Models\Civilian;
use App\Models\Vehicles;
use App\Models\Records;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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

        $suspected = Records::where([
            ['deleted_at', '=', null],
            ['status', '=',  1]
            ]);

        $confirmed = Records::where([
            ['deleted_at', '=', null],
            ['status', '=',  3],
        ]);
            
        $active = Records::where([
            ['deleted_at', '=', null],
            ['status', '=',  3]
            ]);
        
        $negative = Records::where([
            ['deleted_at', '=', null],
            ['status', '=',  2]
            ]);
        
        $recovered = Records::where([
            ['deleted_at', '=', null],
            ['status', '=',  4]
            ]);   
       
        $death = Records::where([
            ['deleted_at', '=', null],
            ['status', '=',  5]
            ]);   
        

        //Get all month of the year

        $months = [];
        $reports = []; 

        $startMonth = Carbon::now()->startOfYear()->format('M');
        $endMonth = Carbon::now()->endOfYear()->format('M');
        $monthRange = CarbonPeriod::create($startMonth, '1 month', $endMonth);

        foreach ($monthRange as $month){
            $months[] = Carbon::parse($month)->format('M');
        }
        
        //Datasets

        //Get reports by category per month

        //Active cases
        $active_ds = $active->get()->groupBy(function($date){
            return Carbon::parse($date->created_at)->month;
        }); 

        //Suspected cases
        $suspected_ds = $suspected->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->month;
        });

         //Recovered cases
        $recovered_ds = $recovered->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->month;
        });

         //Recovered cases
        $death_ds = $death->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->month;
        });

        for($x = 1; $x <= date('m'); $x++){ 
            //active cases
            if(in_array($x , array_keys($active_ds->toArray()))){ 
                $reports['monthly']['active'][] = count($active_ds[$x]);
            }else{ 
                $reports['monthly']['active'][] = 0;
            }

            //suspected cases   
            if(in_array($x , array_keys($suspected_ds->toArray()))){ 
                $reports['monthly']['suspected'][] = count($suspected_ds[$x]);
            }else{ 
                $reports['monthly']['suspected'][] = 0;
            }

            //recovered cases  
            if(in_array($x , array_keys($recovered_ds->toArray()))){ 
                $reports['monthly']['recovered'][] = count($recovered_ds[$x]);
            }else{ 
                $reports['monthly']['recovered'][] = 0;
            }

            //death cases  
            if(in_array($x , array_keys($death_ds->toArray()))){ 
                $reports['monthly']['death'][] = count($death_ds[$x]);
            }else{ 
                $reports['monthly']['death'][] = 0;
            }
        }


        //Get reports by category by day

        //Daily
        $ds_day_active = $active
        ->whereMonth('created_at', Carbon::today()->month)
        ->get()->groupBy(function($date){
            return Carbon::parse($date->created_at)->day;
        }); 


        $ds_day_suspected = $suspected
        ->whereMonth('created_at', Carbon::today()->month)
        ->get()->groupBy(function($date){
            return Carbon::parse($date->created_at)->day;
        }); 

        $ds_day_recovered = $recovered
        ->whereMonth('created_at', Carbon::today()->month)
        ->get()->groupBy(function($date){
            return Carbon::parse($date->created_at)->day;
        }); 

        $ds_day_death = $death
        ->whereMonth('created_at', Carbon::today()->month)
        ->get()->groupBy(function($date){
            return Carbon::parse($date->created_at)->day;
        }); 


        for($x = 1; $x <= date('d'); $x++){ 
            //active cases
            if(in_array($x , array_keys($ds_day_active->toArray()))){ 
                $reports['daily']['active'][] = count($ds_day_active[$x]);
            }else{ 
                $reports['daily']['active'][] = 0;
            }

            //suspected cases
            if(in_array($x , array_keys($ds_day_suspected->toArray()))){ 
                $reports['daily']['suspected'][] = count($ds_day_suspected[$x]);
            }else{ 
                $reports['daily']['suspected'][] = 0;
            }

            //recovered cases
            if(in_array($x , array_keys($ds_day_recovered->toArray()))){ 
                $reports['daily']['recovered'][] = count($ds_day_recovered[$x]);
            }else{ 
                $reports['daily']['recovered'][] = 0;
            }

            //death cases
            if(in_array($x , array_keys($ds_day_death->toArray()))){ 
                $reports['daily']['death'][] = count($ds_day_death[$x]);
            }else{ 
                $reports['daily']['death'][] = 0;
            }
        }
        return view('home', [
            'establishment' => $establishment->get(),
            'civilian' => $civilian->get(), 
            'vehicle' => $vehicle, 
            'confirmed' => $confirmed->get(),
            'suspected' => $suspected->get(),
            'negative' => $negative->get(),
            'active' => $active->get(),
            'recovered' => $recovered->get(),
            'death' => $death->get(),

            //Set for charts
            'months' => $months,
            'reports' => $reports
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
            'active' => $active,
            'recovered' => $recovered,
            'death' => $death,

        ]);
    }
}
