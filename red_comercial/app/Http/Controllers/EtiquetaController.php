<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Etiqueta;

class EtiquetaController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar==''){
            $etiquetas = Etiqueta::orderBy('id', 'desc')->paginate(3);
        }else{
            $etiquetas = Etiqueta::where($criterio, 'like', '%'.$buscar.'%')->orderBy('id', 'desc')->paginate(3);
        }


        return [
            'pagination' => [
                'total' =>        $etiquetas->total(),
                'current_page' => $etiquetas->currentPage(),
                'per_page' =>     $etiquetas->perPage(),
                'last_page' =>    $etiquetas->lastPage(),
                'from' =>         $etiquetas->firstItem(),
                'to' =>           $etiquetas->lastItem(),
            ],
            'etiquetas'=>$etiquetas
        ];
    }//

    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $etiqueta = new Etiqueta();
        $etiqueta->nombre_etiqueta = $request->nombre_etiqueta;
        $etiqueta->descripcion_etiqueta = $request->descripcion_etiqueta;
        $etiqueta->condicion = '1';
        $etiqueta->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $etiqueta = Etiqueta::findOrFail($request->id);
        $etiqueta->nombre_etiqueta = $request->nombre_etiqueta;
        $etiqueta->descripcion_etiqueta = $request->descripcion_etiqueta;
        $etiqueta->condicion = '1';
        $etiqueta->save();
    }

    public function borrar(Request $request){

        if(!$request->ajax()) return redirect('/main');
        
        /*try {
            DB::beginTransaction();*/

            $etiqueta = Etiqueta::findOrFail($request->id);
            $etiqueta->delete();
            
            //DB::commit();
        /*} catch (Exception $e) {
            DB::rollBack();
        }*/
    }
}
