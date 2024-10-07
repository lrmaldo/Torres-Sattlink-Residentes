<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDispositivoRequest;
use App\Http\Requests\UpdateDispositivoRequest;
use App\Models\Dispositivo;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class DispositivoController extends Controller
{

    public $torre_id;

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
    public function create($torre_id)
    {
        return view('dispositivos.create', compact('torre_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDispositivoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDispositivoRequest $request)
    {
        /* resquest tipo file  */
        if ($request->hasFile('img_url')) {
            $file = $request->file('img_url');
            Storage::disk('public')->put('images/', $file);
        }
        $dispositivo = new Dispositivo();
        $dispositivo->tipo = $request->tipo;
        $dispositivo->hostname = $request->hostname;
        $dispositivo->ip = $request->ip;
        $dispositivo->usuario = $request->usuario;
        $dispositivo->password = $request->password;
        $dispositivo->ssid = $request->ssid;
        $dispositivo->numero_de_cliente = $request->numero_de_cliente;
        $dispositivo->marca = $request->marca;
        $dispositivo->modelo = $request->modelo;
        $dispositivo->latitud = $request->latitud;
        $dispositivo->longitud = $request->longitud;
        $dispositivo->img_url = Storage::url($file);
        $dispositivo->comentario = $request->comentario;
        $dispositivo->torre_id = $request->torre_id;
        $dispositivo->estado = $request->estado;
        $dispositivo->save();
        return redirect()->route('torres.show', $request->torre_id)->with('success', 'Dispositivo creado correctamente');

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
        return view('dispositivos.edit', compact('dispositivo'));
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
        /* verificar si existe una imagen en el request para proceder eliminar el que esta en la base de datos  */
        if ($request->hasFile('img_url')) {
            $file = $request->file('img_url');

            /* guardar la imagen en el storage */
            $file = Storage::disk('public')->put('images/', $file);

            /* eliminar la imagen anterior */
            /* eliminar el storage/ */
            Storage::delete('public/' .str_replace('/storage/', '', $dispositivo->img_url));
            $dispositivo->img_url = Storage::url($file);
        }
        $dispositivo->tipo = $request->tipo;
        $dispositivo->hostname = $request->hostname;
        $dispositivo->ip = $request->ip;
        $dispositivo->usuario = $request->usuario;
        $dispositivo->password = $request->password;
        $dispositivo->ssid = $request->ssid;
        $dispositivo->numero_de_cliente = $request->numero_de_cliente;
        $dispositivo->marca = $request->marca;
        $dispositivo->modelo = $request->modelo;
        $dispositivo->latitud = $request->latitud;
        $dispositivo->longitud = $request->longitud;
        $dispositivo->comentario = $request->comentario;
        $dispositivo->estado = $request->estado;

        $dispositivo->save();
        return redirect()->route('torres.show', $dispositivo->torre_id)->with('success', 'Dispositivo actualizado correctamente');
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
        $dispositivos = Dispositivo::where('torre_id', $id)->get();
        //dd($dispositivos);
        return datatables()->of($dispositivos)
            ->addColumn('acciones', function ($dispositivo) {
                /* ver que muestre un modal de vista */
                $button = '<a href="javascript:void(0)" data-toggle="modal" data-target="#viewDispositivoModal" data-id="' . $dispositivo->id . '" class="view btn btn-info btn-sm">Ver</a>';
                $button .= '&nbsp;&nbsp;&nbsp;<a href="/dispositivos/' . $dispositivo->id . '/edit" class="edit btn btn-primary btn-sm">Editar</a>';
                $button .= '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)"  onclick="eliminarDispositivo(' . $dispositivo->id . ')" class="delete btn btn-danger btn-sm">Eliminar</a>';
                return $button;
            })
        /* addcolumn ubicacion */
            ->addColumn('ubicacion', function ($dispositivo) {
                return "<a href='https://www.google.com/maps?q=" . $dispositivo->latitud . "," . $dispositivo->longitud . "' target='_blank'>Ver Ubicacion</a>";
            })
            ->rawColumns(['acciones', 'ubicacion'])

            ->toJson();

    }
}
