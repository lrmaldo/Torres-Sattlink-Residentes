<?php

use App\Http\Controllers\DispositivoController;
use App\Http\Controllers\MapaController;
use App\Http\Controllers\TorreController;
use App\Http\Controllers\UserController;
use App\Models\Dispositivo;
use App\Models\Torre;
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

Route::get('/contacto', function (){
    return view('contacto');
})->name('contacto');

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* post contacto email */
Route::post('enviar-email',[App\Http\Controllers\HomeController::class,'enviarEmail'])->name('enviar-email');

/* auth  */
Route::middleware(['auth'])->group(function () {

    /* ruta de index create store update destroy */
   Route::resource('users', UserController::class);


   Route::resource('torres',TorreController::class);
   ## Route::resource('dispositivos',DispositivoController::class);
   /* dispositivo create */
    Route::get('dispositivos/create/{torre_id}',[DispositivoController::class,'create'])->name('dispositivos.create');

    /* resource only store update edit delete */
    Route::resource('dispositivos',DispositivoController::class)->only(['store','update','edit','destroy']);
   Route::get('mapa', [MapaController::class, 'index'])->name('mapa.index');
   Route::get('torres-data',[TorreController::class,'obtenerTorres'])->name('torres.data');
   Route::get('dispositivos-data/{id}',[DispositivoController::class,'obtenerDispositivos'])->name('dispositivos.data');

   /* calculadora-radio */
    Route::get('calculadora-radio',function(){
         return view('calculadora-radio');
    })->name('calculadora-radio');
});



