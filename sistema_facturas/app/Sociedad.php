<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sociedad extends Model
{
    protected $table = 'sociedades'; //Hace referencia a la tabla Sociedades
    protected $fillable = [
        'nombre', 
        'direccion',
        'rfc_emisor',
        'contacto',
        'email'
    ];
}
