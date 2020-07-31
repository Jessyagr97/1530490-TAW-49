<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class PerfilController extends Controller
{
    /*MOSTRAR INFORMACIÓN DEL USUARIO LOGEADO*/
    public function index(Request $request){

        if(!$request->ajax()) return redirect('/main');

        //LO QUE SE MOSTRARÁ
        $perfil = User::join('tipousuario', 'users.idrol','=', 'tipousuario.id') //TABLA2, TABLA1.IDROL = TABLA2.ID
        ->select('users.id', 'users.nombre', 'users.apellido_p','users.apellido_m', 'users.telefono',
                'users.email', 'users.password', 'users.condicion', 'users.idrol', 
                'tipousuario.rol')
        ->where('users.id', 'like', auth()->id())
        ->orderBy('users.id')->paginate(4);
        
        return [
            'perfil'=>$perfil
        ];
    }
}
