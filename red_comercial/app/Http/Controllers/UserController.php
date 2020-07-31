<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /*MOSTRAR USUARIOS*/
    public function index(Request $request){

        if(!$request->ajax()) return redirect('/main');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        //LO QUE SE MOSTRARÁ
        if($buscar==''){
            $users = User::join('tipousuario', 'users.idrol','=', 'tipousuario.id') //TABLA2, TABLA1.IDROL = TABLA2.ID
            ->select('users.id', 'users.nombre', 'users.apellido_p','users.apellido_m', 'users.telefono',
                    'users.email', 'users.password', 'users.condicion', 'users.idrol', 
                    'tipousuario.rol')
            ->orderBy('users.id')->paginate(4);
        }else{
            $users = User::join('tipousuario', 'users.idrol','=', 'tipousuario.id') //TABLA2, TABLA1.IDROL = TABLA2.ID
            ->select('users.id', 'users.nombre', 'users.apellido_p','users.apellido_m', 'users.telefono',
                    'users.email', 'users.password', 'users.condicion', 'users.idrol', 
                    'tipousuario.rol')
            ->where('users.'.$criterio, 'like', '%'. $buscar.'%')
            ->orderBy('users.id')->paginate(4);
        }

        return [
            'pagination' => [
                'total' =>        $users->total(),
                'current_page' => $users->currentPage(),
                'per_page' =>     $users->perPage(),
                'last_page' =>    $users->lastPage(),
                'from' =>         $users->firstItem(),
                'to' =>           $users->lastItem(),
            ],
            'users'=>$users
        ];
    }
    
    /*REGISTRO DE USUARIOS*/
    public function store(Request $request){

        if(!$request->ajax()) return redirect('/main');

        try{
            //REGISTRO EN LA TABLA USERS
            DB::beginTransaction();
            $user = new User();
            $user->nombre = $request->nombre;
            $user->apellido_p = $request->apellido_p;
            $user->apellido_m = $request->apellido_m;
            $user->telefono = $request->telefono;
            $user->email = $request->email;
            $user->password = bcrypt($request->password); //ENCRIPTADA
            $user->condicion = '1';
            $user->idrol = $request->idrol;
            $user->save();

            /*$cartera = new Cartera();
            $cartera->iduser = $user->id;
            $cartera->dinero = '0';
            $cartera->save();*/

            DB::commit();

        }catch(Exception $e){
            DB::rollBack();
        }
    }

    /*ACTUALIZACION DE USUARIO*/
    public function update(Request $request){

        if(!$request->ajax()) return redirect('/main');

        try {
            DB::beginTransaction();

            $user = User::findOrFail($request->id);

            $user->nombre = $request->nombre;
            $user->apellido_p = $request->apellido_p;
            $user->apellido_m = $request->apellido_m;
            $user->telefono = $request->telefono;
            $user->email = $request->email;
            $user->password = bcrypt($request->password); //ENCRIPTADA
            $user->condicion = '1';
            $user->idrol = $request->idrol;
            $user->save();

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $user = User::findOrFail($request->id);
        $user->condicion = '0';
        $user->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $user = User::findOrFail($request->id);
        $user->condicion = '1';
        $user->save();
    }

    public function borrar(Request $request){

        if(!$request->ajax()) return redirect('/main');
        
        /*try {
            DB::beginTransaction();*/

            $user = User::findOrFail($request->id);
            $user->delete();
            
            //DB::commit();
        /*} catch (Exception $e) {
            DB::rollBack();
        }*/
    }
}
