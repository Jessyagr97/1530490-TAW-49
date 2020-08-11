<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas'; //Hace referencia a la tabla galeria
    protected $fillable = [
        'nombre_empresa', 
        'descripcion_empresa',
        'telefono_empresa',
        'email_empresa',
        'longitud',
        'latitud',
        'idgiro',
        'iduser',
        'imagen_empresa'
    ];
}
