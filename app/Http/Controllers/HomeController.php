<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('torres.index');
    }

    public function enviarEmail(Request $request)
    {
        $nombre = $request->nombre;
        $email = $request->email;
        $asunto = $request->asunto;
        $mensaje = $request->mensaje;
        $data = array('nombre' => $nombre, 'email' => $email, 'asunto' => $asunto, 'mensaje' => $mensaje);
        Mail::send('emails.contacto', $data, function ($message) {
            $message->from('miappshop@sattlink.com', 'Sattlink Torres');
            $message->to('info@sattlink.com')->subject('Contacto desde la web');
        });

        return redirect('/contacto')->with('success', 'Correo enviado correctamente');
    }
}
