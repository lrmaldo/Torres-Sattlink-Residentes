<?php

use App\Http\Controllers\UserController;
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
    Route::get('/users', function () {
        return view('users.index');
    });
    /* ruta de edit user */
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    /* ruta update */
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
});



