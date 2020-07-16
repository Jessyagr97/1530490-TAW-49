<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use App\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar==''){
            $categorias = Categoria::orderBy('id', 'desc')->paginate(4);
        }else{
            $categorias = Categoria::where($criterio, 'like', '%'.$buscar.'%')->orderBy('id', 'desc')->paginate(4);
        }


        return [
            'pagination' => [
                'total' =>        $categorias->total(),
                'current_page' => $categorias->currentPage(),
                'per_page' =>     $categorias->perPage(),
                'last_page' =>    $categorias->lastPage(),
                'from' =>         $categorias->firstItem(),
                'to' =>           $categorias->lastItem(),
            ],
            'categorias'=>$categorias
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $categoria = new Categoria();
        $categoria->nombre_categoria = $request->nombre_categoria;
        $categoria->descripcion_categoria = $request->descripcion_categoria;
        $categoria->condicion = '1';
        $categoria->save();
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
        $categoria = Categoria::findOrFail($request->id);
        $categoria->nombre_categoria = $request->nombre_categoria;
        $categoria->descripcion_categoria = $request->descripcion_categoria;
        $categoria->condicion = '1';
        $categoria->save();
    }

    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $categoria = Categoria::findOrFail($request->id);
        $categoria->condicion = '0';
        $categoria->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $categoria = Categoria::findOrFail($request->id);
        $categoria->condicion = '1';
        $categoria->save();
    }

    public function borrar(Request $request){

        if(!$request->ajax()) return redirect('/main');
        
        /*try {
            DB::beginTransaction();*/

            $categoria = Categoria::findOrFail($request->id);
            $categoria->delete();
            
            //DB::commit();
        /*} catch (Exception $e) {
            DB::rollBack();
        }*/
    }
}
