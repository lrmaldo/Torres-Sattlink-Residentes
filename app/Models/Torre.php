<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Torre extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'latitud',
        'longitud',
        'comentarios',
        'estado',
        'direccion',
        'img_url',
        'altura',
    ];

    public function dispositivos()
    {
        return $this->hasMany(Dispositivo::class);
    }
}
