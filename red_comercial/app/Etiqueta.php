<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    protected $fillable = ['nombre_etiqutea', 'descripcion_etiqueta', 'condicion'];
}
