<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'facturas'; //Hace referencia a la tabla Facturas
    protected $fillable = [
        'idsociedad', 
        'razon',
        'rfc_receptor',
        'folio',
        'doc_pdf',
        'doc_xml'
    ];
}
