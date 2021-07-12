<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register',  [App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('/login',  [App\Http\Controllers\API\AuthController::class, 'login']);

Route::middleware(['auth:api'])->group(function(){ 
    Route::get('stats', [App\Http\Controllers\HomeController::class, 'stats']);
    Route::get('status', [App\Http\Controllers\API\AuthController::class, 'status']);
    Route::resource('logs_civilians', LogsCivilianAPIController::class);
    Route::resource('logs_establishments', LogsEstablishmentAPIController::class);
    Route::resource('logs_vehicles', LogsVehicleAPIController::class);
});


