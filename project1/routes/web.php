<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Ruta para el controller de los empleados
Route::resource('empleados','empleadosController');



/*
Route::get('/', function () {
    return view('welcome');
});

//Ruta de listado de productos (mediante el método GET)
Route::get('/productos', function () {
    return ('Listado de productos');
});

//Ruta de listado de productos (mediante el método POST)
Route::post('/productos', function () {
    return ('Almacenando productos');
});

//Ruta de listado de productos (mediante el método PUT)
Route::put('/productos/{id}', function ($id) {
    return ('Actualizando producto: ' . $id);
});

//Ruta que acepte numeros en un rango
Route::get('/productos2/{$id}', function ($id) {
    return 'Mostrando producto: ' .$id;
})->where ('id', '[0-9]+');
*/

//Ruta con parametros opcionales
/*
Route::get('/saludo/{$name}/{$nickname?}', function ($name, $nickname = null) {
    //Poner la primera letra en mayuscula
    $name = ucfirst($name);
    //validar si un usuario tiene nickname
    if ($nickname){
        return "Bienvenido {$name}, tu nickname es {$nickname}";
    }else{
        return "Bienvenido {$name}";
    }
    
})->where ('id', '[0-9]+');*/

//METODOS: get, post, put, delete
