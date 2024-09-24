<?php

use App\Http\Controllers\MapaController;
use App\Http\Controllers\TorreController;
use App\Http\Controllers\UserController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/* auth  */
Route::middleware(['auth'])->group(function () {

    /* ruta de edit user */
   Route::resource('users', UserController::class);

   Route::resource('torres',TorreController::class);
   Route::get('mapa', [MapaController::class, 'index']);
   Route::get('torres-data',[TorreController::class,'obtenerTorres'])->name('torres.data');
});



