<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispositivo extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'hostname',
        'ip',
        'usuario',
        'password',
        'ssid',
        'numero_de_cliente',
        'marca',
        'modelo',
        'latitud',
        'longitud',
        'img_url',
        'comentario',
        'torre_id',
        'radio_transmision',
        'estado',
        'torre_id'
    ];

    public function torre()
    {
        return $this->belongsTo(Torre::class);
    }
}
