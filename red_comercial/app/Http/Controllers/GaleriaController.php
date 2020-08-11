<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Galeria;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;

class GaleriaController extends Controller
{
    /*MOSTRAR IMAGENES*/
    public function index(Request $request){

        if(!$request->ajax()) return redirect('/main');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        //LO QUE SE MOSTRARÁ
        if($buscar==''){
            $galeria = Galeria::join('users', 'galeria.iduser','=', 'users.id') //TABLA2, TABLA1.IDROL = TABLA2.ID
            ->select('galeria.id', 'galeria.ruta', 'galeria.iduser')
            ->where('galeria.iduser', 'like', auth()->id())
            ->orderBy('galeria.id')->paginate(4);
        }else{
            $galeria = Galeria::join('users', 'galeria.iduser','=', 'users.id') //TABLA2, TABLA1.IDROL = TABLA2.ID
            ->select('galeria.id', 'galeria.ruta', 'galeria.iduser')
            ->where('galeria.iduser', 'like', auth()->id())
            ->where('galeria.'.$criterio, 'like', '%'. $buscar.'%')
            ->orderBy('galeria.id')->paginate(4);
        }

        return [
            'pagination' => [
                'total' =>        $galeria->total(),
                'current_page' => $galeria->currentPage(),
                'per_page' =>     $galeria->perPage(),
                'last_page' =>    $galeria->lastPage(),
                'from' =>         $galeria->firstItem(),
                'to' =>           $galeria->lastItem(),
            ],
            'galeria'=>$galeria
        ];
    }

    /*SUBIR IMAGEN*/
    public function store(Request $request){

        if(!$request->ajax()) return redirect('/main');

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $file_name = $file->getClientOriginalName();
            $file_path = 'public/'.auth()->user()->email.'/img/';
            $file_path_s = '/storage/'.auth()->user()->email.'/img/';
            $file->storeAs($file_path, $file_name);
        } else {
            return response()->json(['error'=>'El archivo no existe.']);
        }

        try{
            //REGISTRO EN LA TABLA GALERIA
            DB::beginTransaction();
            $galeria = new Galeria();
            $galeria->ruta = $file_path_s.$file_name;
            $galeria->iduser = auth()->id();
            $galeria->save();
            DB::commit();

        }catch(Exception $e){
            DB::rollBack();
        }

    }

    /*BORRAR IMAGEN */
    public function borrar(Request $request){

        if(!$request->ajax()) return redirect('/main');

        $imagen = Galeria::findOrFail($request->id);
        $imagen->delete();

        unlink(storage_path($request->ruta));
            
    }
}
