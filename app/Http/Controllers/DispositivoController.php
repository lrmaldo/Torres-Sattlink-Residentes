<?php

namespace App\Http\Controllers;

use App\Models\Dispositivo;
use App\Http\Requests\StoreDispositivoRequest;
use App\Http\Requests\UpdateDispositivoRequest;
use App\Models\Torre;

class DispositivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDispositivoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDispositivoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dispositivo  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function show(Dispositivo $dispositivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dispositivo  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function edit(Dispositivo $dispositivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDispositivoRequest  $request
     * @param  \App\Models\Dispositivo  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDispositivoRequest $request, Dispositivo $dispositivo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dispositivo  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dispositivo $dispositivo)
    {
        //
    }

    public function obtenerDispositivos($id)
    {
        $dispositivos = Dispositivo::where('torre_id',$id)->get();
        //dd($dispositivos);
        return datatables()->of($dispositivos)
        ->addColumn('action', function($dispositivo){
            $button = '<a href="/dispositivos/'.$dispositivo->id.'/edit" class="edit btn btn-primary btn-sm">Editar</a>';
            $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="'.$dispositivo->id.'" class="delete btn btn-danger btn-sm">Eliminar</button>';
            return $button;
        })
        ->rawColumns(['action'])
        ->toJson();

    }
}
