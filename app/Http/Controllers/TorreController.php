<?php

namespace App\Http\Controllers;

use App\Models\Torre;
use App\Http\Requests\StoreTorreRequest;
use App\Http\Requests\UpdateTorreRequest;

class TorreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $totalTorres = Torre::all()->count();
       $torresActivos = Torre::where('estado',1)->count();
       //db select y count select count(*) from torres where estado = 1
       //
       /* torresAlertas */
         $torresMantenimiento = Torre::where('estado',2)->count();
         $torresInactivos = Torre::where('estado',0)->count();


       return view('torres.index',compact('totalTorres','torresActivos','torresMantenimiento','torresInactivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('torres.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTorreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTorreRequest $request)
    {
        $torre = new Torre();
        $torre->nombre = $request->nombre;
        $torre->latitud = $request->latitud;
        $torre->longitud = $request->longitud;
        $torre->comentarios = $request->comentarios;
        $torre->estado = $request->estado;
        $torre->save();
        return redirect()->route('torres.index')->with('success','Torre creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Torre  $torre
     * @return \Illuminate\Http\Response
     */
    public function show(Torre $torre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Torre  $torre
     * @return \Illuminate\Http\Response
     */
    public function edit(Torre $torre)
    {
        $torre = Torre::find($id);
        return view('torre.edit', compact('torre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTorreRequest  $request
     * @param  \App\Models\Torre  $torre
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTorreRequest $request, Torre $torre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Torre  $torre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Torre $torre)
    {
        //
    }
}
