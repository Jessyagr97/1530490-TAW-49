<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Empleado;
use App\Departamento;


//1.- Listar empleados
Route::get('empleados', function(){
    $empleados = Empleado::get();
    return $empleados;
});

//2.- Guardar empleado
Route::post('empleados', function(Request $request){
    //Validar data de empleado
    $request -> validate([
        'nombres' => 'required|max:50',
        'apellidos' => 'required|max:50',
        'cedula' => 'required|max:20',
        'email' => 'required|email|unique:empleados|max:50',
        'lugar_nacimiento' => 'required|max:50',
        'sexo' => 'required|max:20',
        'estado_civil' => 'required|max:50',
        'departamento'=> 'required|max:20',
        'telefono' => 'required|numeric'
    ]);

    //Parámetros
    $empleado = new Empleado;
    $empleado->nombres = $request->input('nombres');
    $empleado->apellidos = $request->input('apellidos');
    $empleado->cedula = $request->input('cedula');
    $empleado->email = $request->input('email');
    $empleado->lugar_nacimiento = $request->input('lugar_nacimiento');
    $empleado->sexo = $request->input('sexo');
    $empleado ->estado_civil = $request->input('estado_civil');
    $empleado->departamento = $request->input('departamento');
    $empleado->telefono = $request->input('telefono');

    $empleado->save();
    return 'Empleado creado';    
});

//3.- Actualizar empleado
Route::put('empleados/{id}', function(Request $request, $id){
    //Validar data de empleados
    $request -> validate([
        'nombres' => 'required|max:50',
        'apellidos' => 'required|max:50',
        'cedula' => 'required|max:20',
        'email' => 'required|max:50|email|unique:empleados,email'.$id,
        'lugar_nacimiento' => 'required|max:50',
        'sexo' => 'required|max:20',
        'estado_civil' => 'required|max:50',
        'departamento'=> 'required|max:20',
        'telefono' => 'required|numeric'
    ]);

    $empleado = Empleado::findOrFail($id);
    $empleado->nombres = $request -> input('nombres');
    $empleado->apellidos = $request -> input('apellidos');
    $empleado->cedula = $request -> input('cedula');
    $empleado->email = $request -> input('email');
    $empleado->lugar_nacimiento = $request -> input('lugar_nacimiento');
    $empleado->sexo = $request -> input('sexo');
    $empleado->estado_civil = $request -> input('estado_civil');
    $empleado->telefono = $request -> input('telefono');
    $empleado->departamento = $request->input('departamento');
    $empleado->save();
    return "Empleado actualizado";
    //return $empleado;
});

//4.- Eliminar empleados
Route::delete('empleados/{id}',function($id){
    $empleado = Empleado::findOrFail($id);
    $empleado -> delete();
    return "Empleado eliminado";
});

//5.- Listar departamentos
Route::get('departamentos', function(){
    $departamentos = Departamento::get();
    return $departamentos;
});

Route::get('departamentos/{id}', function($id){
    $departamentos = Departamento::find($id);
    return $departamentos;
});

// 6.- Guardar departamentos 
Route::post('departamentos', function(Request $request){

    $request->validate([
        'nombres'=> 'required|max:30',
    ]);
    
    // Parámetros
    $departamento = new Departamento;
    $departamento->nombres = $request->input('nombre');
    $departamento->save();
    
    return 'Departamento creado';
});

// 7.- Actualizar departamento
Route::put('departamentos/{id}', function(Request $request, $id){
    
    $request->validate([
        'nombres'=> 'required|max:30',
    ]);

    $departamento = Departamento::findOrFail($id);

    $departamento->nombres = $request->input('nombre');
    $departamento->save();

    return "Departamento actualizado";
});

// 8.- Eliminar departamento
Route::delete('departamentos/{id}',function($id){
    
    $departamento = Departamento::findOrFail($id);
    $departamento->delete();
    return "Departamento eliminado";
});

/*
//Guardar empleados fase 1
Route::post('empleados', function(Request $request){
    //validar data de empleados
    $request -> validate([
        'nombres' => 'required|max:50',
        'apellidos' => 'required|max:50',
        'cedula' => 'required|max:20',
        'email' => 'required|max:50|email|unique:empleados',
        'lugar_nacimiento' => 'required|max:50',
        'sexo' => 'required|max:20',
        'estado_civil' => 'required|max:50',
        'telefono' => 'required|numeric',
    ]);

    $empleado = new Empleado;
    $empleado -> nombres = $request->input('nombres');
    $empleado -> apellidos = $request->input('apellidos');
    $empleado -> cedula = $request->input('cedula');
    $empleado -> email = $request->input('email');
    $empleado -> lugar_nacimiento = $request->input('lugar_nacimiento');
    $empleado -> sexo = $request->input('sexo');
    $empleado -> estado_civil = $request->input('estado_civil');
    $empleado -> telefono = $request->input('telefono');
    //metodo de guardado
    $empleado->save();

    return 'Empleado creado';
    //return $request-> all();
});



/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/