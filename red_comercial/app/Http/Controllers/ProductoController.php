<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/main');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar==''){
            $productos = Producto::join('categorias', 'productos.idcategoria','=', 'categorias.id')
                                 ->join('empresas', 'productos.idempresa','=', 'empresas.id')
                                 ->join('users', 'productos.iduser','=', 'users.id')
            ->select('productos.imagen_producto', 'productos.nombre_producto', 'productos.descripcion_producto',
                     'empresas.nombre_empresa', 'categorias.nombre_categoria','productos.stock', 'productos.condicion')
            ->orderBy('productos.id', 'desc')->paginate(4);
        }else{
            $productos = Producto::join('categorias', 'productos.idcategoria','=', 'categorias.id')
                                ->join('empresas', 'productos.idempresa','=', 'empresas.id')
                                ->join('users', 'productos.iduser','=', 'users.id')
            ->select('productos.imagen_producto', 'productos.nombre_producto', 'productos.descripcion_producto',
                    'empresas.nombre_empresa', 'categorias.nombre_categoria','productos.stock', 'productos.condicion')
            ->where($criterio, 'like', '%'.$buscar.'%')
            ->orderBy('id', 'desc')->paginate(4);
        }


        return [
            'pagination' => [
                'total' =>        $productos->total(),
                'current_page' => $productos->currentPage(),
                'per_page' =>     $productos->perPage(),
                'last_page' =>    $productos->lastPage(),
                'from' =>         $productos->firstItem(),
                'to' =>           $productos->lastItem(),
            ],
            'productos'=>$productos
        ];
    }
}
