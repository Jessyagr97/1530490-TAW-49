<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    protected $table = 'galeria'; //Hace referencia a la tabla galeria
    protected $fillable = ['ruta', 'iduser'];
}
