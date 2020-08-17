<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura;

class BusquedaController extends Controller
{
    /*MOSTRAR FACTURAS*/
    public function index(Request $request){

        //if(!$request->ajax()) return redirect('/main');

        $idsociedad = $request->idsociedad;
        $razon = $request->razon;
        $rfc_receptor = $request->rfc_receptor;
        $folio = $request->folio;

        $criterio = $request->criterio;

        //LO QUE SE MOSTRARÁ
            $facturas = Factura::join('sociedades', 'facturas.idsociedad', '=', 'sociedades.id')->
            select('facturas.id', 'facturas.razon', 'facturas.rfc_receptor', 'facturas.folio',
                    'facturas.doc_pdf', 'facturas.doc_xml', 'sociedades.nombre', 'sociedades.id')
            ->where('sociedades.id', 'like', '%'. $idsociedad.'%', 'and',
                     'facturas.rfc_receptor', 'like', '%'.$rfc_receptor.'%', 'and',
                     'facturas.razon', 'like', '%'.$razon.'%')
            ->orderBy('facturas.id')->paginate(4);

        return [
            'pagination' => [
                'total' =>        $facturas->total(),
                'current_page' => $facturas->currentPage(),
                'per_page' =>     $facturas->perPage(),
                'last_page' =>    $facturas->lastPage(),
                'from' =>         $facturas->firstItem(),
                'to' =>           $facturas->lastItem(),
            ],
            'facturas'=>$facturas
        ];
    }
}
