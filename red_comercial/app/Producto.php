<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos'; //Hace referencia a la tabla galeria
    protected $fillable = [
        'nombre_producto', 
        'descripcion_producto',
        'precio_producto',
        'stock',
        'imagen_producto',
        'condicion',
        'idcategoria',
        'idempresa',
        'iduser'
    ];
}
