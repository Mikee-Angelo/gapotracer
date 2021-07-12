<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/maps', [App\Http\Controllers\MapsController::class, 'index']);

Route::resource('civilians', App\Http\Controllers\CivilianController::class);
Route::post('/civilians/{id}/status', [App\Http\Controllers\CivilianController::class, 'status']);
Route::get('/civilians/print/{uuid}/', [App\Http\Controllers\CivilianController::class, 'print']);

Route::resource('establishments', App\Http\Controllers\EstablishmentController::class);
Route::get('/establishments/print/{uuid}/', [App\Http\Controllers\EstablishmentController::class, 'print']);

Route::resource('vehicles', App\Http\Controllers\VehiclesController::class);

Route::resource('users', App\Http\Controllers\UserController::class)->middleware('auth');

Route::resource('logsCivilians', App\Http\Controllers\LogsCivilianController::class, ['only' => [ 'index', 'show','destroy' ,'edit']]);

Route::resource('logsEstablishments', App\Http\Controllers\LogsEstablishmentController::class, ['only' => [ 'index', 'show','destroy' ,'edit']]);

Route::resource('logsVehicles', App\Http\Controllers\LogsVehicleController::class);