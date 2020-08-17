<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /*MOSTRAR USUARIOS*/
    public function index(Request $request){

        if(!$request->ajax()) return redirect('/main');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        //LO QUE SE MOSTRARÁ
        if($buscar==''){
            $users = User::join('roles', 'users.idrol','=', 'roles.id') //TABLA2, TABLA1.IDROL = TABLA2.ID
            ->join('sociedades', 'users.idsociedad', '=', 'sociedades.id')
            ->select('users.id', 'users.nombre AS nombre_usuario', 'users.usuario', 'users.idsociedad',
                    'users.password', 'users.image_profile', 'users.condicion', 'users.idrol', 
                    'roles.rol', 'sociedades.nombre')
            ->orderBy('users.id')->paginate(4);
        }else{
            $users = User::join('roles', 'users.idrol','=', 'roles.id') //TABLA2, TABLA1.IDROL = TABLA2.ID
            ->join('sociedades', 'users.idsociedad', '=', 'sociedades.id')
            ->select('users.id', 'users.nombre AS nombre_usuario', 'users.usuario', 'users.idsociedad',
            'users.password', 'users.image_profile', 'users.condicion', 'users.idrol', 
            'roles.rol', 'sociedades.nombre')
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

       /*CREAR DIRECTORIO DE USUARIO*/
       $path = 'public/'.$request->usuario.'/img/';
       Storage::makeDirectory($path);
       
       $path = 'public/'.$request->usuario.'/docs/';
       Storage::makeDirectory($path);
       /*==============================*/

       /*SUBIR IMAGEN*/
        if ($request->hasFile('image_profile')) {
            $file = $request->file('image_profile');
            $file_name = $file->getClientOriginalName();
            $file_path = 'public/'.$request->usuario.'/img/';
            $file_path_s = '/storage/'.$request->usuario.'/img/';
            $file->storeAs($file_path, $file_name);
        } else {
            return response()->json(['error'=>'El archivo no existe.']);
        }
        /*==============================*/

        try{
            //REGISTRO EN LA TABLA USERS
            DB::beginTransaction();
            $user = new User();
            $user->nombre = $request->nombre;
            $user->usuario = $request->usuario;
            $user->password = bcrypt($request->password); //ENCRIPTADA
            $user->image_profile = $file_path_s.$file_name;
            $user->condicion = '1';
            $user->idrol = '1';
            $user->idsociedad = $request->idsociedad;
            $user->save();

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
            $user->usuario = $request->usuario;
            $user->password = bcrypt($request->password); //ENCRIPTADA
            $user->image_profile = $request->image_profile;
            $user->condicion = '1';
            $user->idrol = '1';
            $user->idsociedad = $request->idsociedad;
            $user->save();

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function borrar(Request $request){

        if(!$request->ajax()) return redirect('/main');
        
        /*try {
            DB::beginTransaction();*/

            $files = Storage::allFiles('app/public/'.$request->usuario);

            $user = User::findOrFail($request->id);
            $user->delete();
            
            //DB::commit();
        /*} catch (Exception $e) {
            DB::rollBack();
        }*/
    }
}
