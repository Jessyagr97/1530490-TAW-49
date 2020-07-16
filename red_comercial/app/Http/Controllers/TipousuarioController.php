<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipousuario;

class TipousuarioController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar==''){
            $tipousuario = Tipousuario::orderBy('id', 'desc')->paginate(4);
        }else{
            $tipousuario = Tipousuario::where($criterio, 'like', '%'.$buscar.'%')->orderBy('id', 'desc')->paginate(4);
        }


        return [
            'pagination' => [
                'total' =>        $tipousuario->total(),
                'current_page' => $tipousuario->currentPage(),
                'per_page' =>     $tipousuario->perPage(),
                'last_page' =>    $tipousuario->lastPage(),
                'from' =>         $tipousuario->firstItem(),
                'to' =>           $tipousuario->lastItem(),
            ],
            'tipousuario'=>$tipousuario
        ];
    }

    public function selectRol(Request $request){
       $roles = Tipousuario::where('condicion', '=', 1)
        ->select('id', 'rol')
        ->orderBy('rol', 'asc')->get();

        return ['roles' => $roles];
    }
}
