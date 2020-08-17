<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura;
use App\Reporte;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class FacturaController extends Controller
{

    /*MOSTRAR FACTURAS*/
    public function index(Request $request){

        if(!$request->ajax()) return redirect('/main');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        //LO QUE SE MOSTRARÁ
        if($buscar==''){
            $facturas = Factura::join('sociedades', 'facturas.idsociedad', '=', 'sociedades.id')->
            select('facturas.id', 'facturas.razon', 'facturas.rfc_receptor', 'facturas.folio',
                    'facturas.doc_pdf', 'facturas.doc_xml', 'sociedades.nombre')
            ->orderBy('facturas.id')->paginate(4);
        }else{
            $facturas = Factura::join('sociedades', 'facturas.idsociedad', '=', 'sociedades.id')->
            select('facturas.id', 'facturas.razon', 'facturas.rfc_receptor', 'facturas.folio',
                    'facturas.doc_pdf', 'facturas.doc_xml', 'sociedades.nombre')
            ->where('facturas.'.$criterio, 'like', '%'. $buscar.'%')
            ->orderBy('facturas.id')->paginate(4);
        }

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

    /*REGISTRO DE FACTURAS*/
    public function store(Request $request){

        if(!$request->ajax()) return redirect('/main');

        /*SUBIR DOCS*/
        //PDF
        if ($request->hasFile('doc_pdf')) {
            $file = $request->file('doc_pdf');
            $file_nameP = $file->getClientOriginalName();
            $file_path = 'public/'.auth()->user()->usuario.'/docs/';
            $file_path_sP = '/storage/'.auth()->user()->usuario.'/docs/';
            $file->storeAs($file_path, $file_nameP);
        } else {
            return response()->json(['error'=>'El archivo no existe.']);
        }
        $file = '';
        //XML
        if ($request->hasFile('doc_xml')) {
            $file = $request->file('doc_xml');
            $file_nameX = $file->getClientOriginalName();
            $file_path = 'public/'.auth()->user()->usuario.'/docs/';
            $file_path_sX = '/storage/'.auth()->user()->usuario.'/docs/';
            $file->storeAs($file_path, $file_nameX);
        }else {
            $file_path_sX = '';
            $file_nameX = '';
        }
        /*==============================*/

        try{
            //REGISTRO EN LA TABLA FACTURAS
            DB::beginTransaction();
            $factura = new Factura();
            $factura->idsociedad = $request->idsociedad;
            $factura->razon = $request->razon;
            $factura->rfc_receptor = $request->rfc_receptor;
            $factura->folio = $request->folio;
            $factura->doc_pdf = $file_path_sP.$file_nameP;
            $factura->doc_xml = $file_path_sX.$file_nameX;
            $factura->save();
            
            $reporte = new Reporte();
            $reporte->idusuario = auth()->user()->id;
            $reporte->idsociedad = $request->idsociedad;
            $reporte->idfactura = $factura->id;
            $reporte->save();

            DB::commit();

        }catch(Exception $e){
            DB::rollBack();
        }
    }

    public function downloadPDF(Request $request){
        return Storage::download('/Jessica/docs/JIDHCV.pdf');
    }

    public function borrar(Request $request){

        if(!$request->ajax()) return redirect('/main');
        
        /*try {
            DB::beginTransaction();*/

            $factura = Factura::findOrFail($request->id);
            $factura->delete();
            
            //DB::commit();
        /*} catch (Exception $e) {
            DB::rollBack();
        }*/
    }
}
