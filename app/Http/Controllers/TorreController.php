<?php

namespace App\Http\Controllers;

use App\Models\Torre;
use App\Http\Requests\StoreTorreRequest;
use App\Http\Requests\UpdateTorreRequest;
use App\Models\Dispositivo;
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
        $totalDispositivos = Dispositivo::where('torre_id', $torre->id)
        ->count();
        $DispositivosActivos = 0;
        $DispositivosInactivos = 0;
        $DispositivosMantenimiento = 0;
       return view('torres.show',compact('torre','totalDispositivos','DispositivosActivos','DispositivosInactivos','DispositivosMantenimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Torre  $torre
     * @return \Illuminate\Http\Response
     */
    public function edit(Torre $torre)
    {
       /*  $torre = Torre::find($id); */
        return view('torres.edit', compact('torre'));
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

        $torre->nombre = $request->nombre;
        $torre->latitud = $request->latitud;
        $torre->longitud = $request->longitud;
        $torre->comentarios = $request->comentarios;
        $torre->estado = $request->estado;
        $torre->save();
        return redirect()->route('torres.index')->with('success','Torre Actualizada Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Torre  $torre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Torre $torre)
    {
       $torre->delete();
       return response()->json(['mensaje'=> 'Se elimino correctamente'],200);
    }

    public function obtenerTorres(){
        $torres = Torre::all();
        return datatables()->of($torres)
        ->addColumn('ultima_revision',function($torre){
            return $torre->updated_at->diffForHumans();
        })
        /* acciones columna */
        ->addColumn('acciones',function($torre){
            /* btn dispositivos */
            $btns = '<a href="'.route('torres.show',$torre->id).'" class="btn btn-primary btn-sm mx-1">Dispositivos</a>';



            $btns .= '<a href="'.route('torres.edit',$torre->id).'" class="btn btn-primary btn-sm mx-1">Editar</a>';
            $btns .= '<a href="javascript:void(0)" onclick="eliminarTorre('.$torre->id.')" class="btn btn-danger btn-sm mx-1">Eliminar</a>';
            return $btns;
        })
        /* ubicacion columna */
        ->addColumn('ubicacion',function($torre){
            return '<a href="https://www.google.com/maps?q='.$torre->latitud.','.$torre->longitud.'" target="_blank">Ver ubicacion</a>';
        })
        /* editar columna estado */
        ->editColumn('estado',function($torre){
            if($torre->estado == 1){
                return '<span class="badge badge-success">Activo</span>';
            }elseif($torre->estado == 2){
                return '<span class="badge badge-warning">Mantenimiento</span>';
            }else{
                return '<span class="badge badge-danger">Inactivo</span>';
            }
        })
        ->rawColumns(['acciones','ubicacion','estado'])
        ->toJson();
    }
}
