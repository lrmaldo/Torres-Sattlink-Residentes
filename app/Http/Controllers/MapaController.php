<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Torre;

class MapaController extends Controller
{

    public function index()
    {
        return view('mapa.index');
    }
    //function  obtenerTorresYDispositivos(){

     public function obtenerTorresYDispositivos(){
        $torres = Torre::with('dispositivos')->get();
        return response()->json($torres);
     }
}
