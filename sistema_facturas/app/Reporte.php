<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table = 'reportes'; //Hace referencia a la tabla Facturas
    protected $fillable = [
        'idusuario', 
        'idsociedad',
        'idfactura'
    ];
}
