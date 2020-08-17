<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reporte;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    /*MOSTRAR FACTURAS*/
    public function index(Request $request){

        if(!$request->ajax()) return redirect('/main');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        //LO QUE SE MOSTRARÁ
        if($buscar==''){
            $reportes = Reporte::join('sociedades', 'reportes.idsociedad', '=', 'sociedades.id')->
                                join('users', 'reportes.idusuario', '=', 'users.id')->
                                join('facturas', 'reportes.idfactura', '=', 'facturas.id')->
            select('reportes.id', 'users.usuario', 'sociedades.nombre', 'facturas.razon')
            ->orderBy('reportes.id')->paginate(4);
        }else{
            $reportes = Reporte::join('sociedades', 'reportes.idsociedad', '=', 'sociedades.id')->
                                join('users', 'reportes.idusuario', '=', 'users.id')->
                                join('facturas', 'reportes.idfactura', '=', 'facturas.id')->
            select('reportes.id', 'users.usuario', 'sociedades.nombre', 'facturas.razon')
            ->where('facturas.'.$criterio, 'like', '%'. $buscar.'%')
            ->orderBy('reportes.id')->paginate(4);
        }

        return [
            'pagination' => [
                'total' =>        $reportes->total(),
                'current_page' => $reportes->currentPage(),
                'per_page' =>     $reportes->perPage(),
                'last_page' =>    $reportes->lastPage(),
                'from' =>         $reportes->firstItem(),
                'to' =>           $reportes->lastItem(),
            ],
            'reportes'=>$reportes
        ];
    }

    public function borrar(Request $request){

        if(!$request->ajax()) return redirect('/main');
        

            $reporte = Reporte::findOrFail($request->id);
            $reporte->delete();
            
    }
}
