<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sociedad;
use Illuminate\Support\Facades\DB;

class SociedadController extends Controller
{

    /*MOSTRAR SOCIEDADES EMISORAS*/
    public function index(Request $request){

        if(!$request->ajax()) return redirect('/main');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        //LO QUE SE MOSTRARÁ
        if($buscar==''){
            $sociedades = Sociedad::select('sociedades.id', 'sociedades.nombre', 'sociedades.direccion', 'sociedades.rfc_emisor',
                    'sociedades.contacto', 'sociedades.email')
            ->orderBy('sociedades.id')->paginate(4);
        }else{
            $sociedades = Sociedad::select('sociedades.id', 'sociedades.nombre', 'sociedades.direccion', 'sociedades.rfc_emisor',
            'sociedades.contacto', 'sociedades.email')
            ->where('sociedades.'.$criterio, 'like', '%'. $buscar.'%')
            ->orderBy('sociedades.id')->paginate(4);
        }

        return [
            'pagination' => [
                'total' =>        $sociedades->total(),
                'current_page' => $sociedades->currentPage(),
                'per_page' =>     $sociedades->perPage(),
                'last_page' =>    $sociedades->lastPage(),
                'from' =>         $sociedades->firstItem(),
                'to' =>           $sociedades->lastItem(),
            ],
            'sociedades'=>$sociedades
        ];
    }

    /*REGISTRO DE SOCEIDADES*/
    public function store(Request $request){

        if(!$request->ajax()) return redirect('/main');

        try{
            //REGISTRO EN LA TABLA SOCIEDADES
            DB::beginTransaction();
            $soceidad = new Sociedad();
            $soceidad->nombre = $request->nombre;
            $soceidad->direccion = $request->direccion;
            $soceidad->rfc_emisor = $request->rfc_emisor; 
            $soceidad->contacto = $request->contacto;
            $soceidad->email = $request->email;
            $soceidad->save();

            DB::commit();

        }catch(Exception $e){
            DB::rollBack();
        }
    }

    /*ACTUALIZACION DE SOCIEDAD*/
    public function update(Request $request){

        if(!$request->ajax()) return redirect('/main');

        try {
            DB::beginTransaction();

            $sociedad = Sociedad::findOrFail($request->id);

            $sociedad->nombre = $request->nombre;
            $sociedad->direccion = $request->direccion;
            $sociedad->rfc_emisor = $request->rfc_emisor; //ENCRIPTADA
            $sociedad->contacto = $request->contacto;
            $sociedad->email = $request->email;
            $sociedad->save();

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function borrar(Request $request){

        if(!$request->ajax()) return redirect('/main');
        
        /*try {
            DB::beginTransaction();*/

            $sociedad = Sociedad::findOrFail($request->id);
            $sociedad->delete();
            
            //DB::commit();
        /*} catch (Exception $e) {
            DB::rollBack();
        }*/
    }

    public function selectRolPublic(Request $request){
        $sociedades = Sociedad::select('id', 'nombre')
         ->orderBy('id', 'asc')->get();
 
         return ['sociedades' => $sociedades];
    }

    public function selectRol(Request $request){
        $sociedades = Sociedad::select('id', 'nombre')
         ->orderBy('id', 'asc')->get();
 
         return ['sociedades' => $sociedades];
    }
}
