<?php

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

/*PAGINA DE BUSQUEDA*/
Route::get('/', function () {
    return view('welcome');
});

/*DASHBOARD+++++++++++++++++++++++++++++*/
Route::get('/main', function () {
    return view('contenido/contenido');
})->name('main');
    /*CATEGORIA*/
    Route::get('/categoria', 'CategoriaController@index');
    Route::post('/categoria/registrar', 'CategoriaController@store');
    Route::put('/categoria/actualizar', 'CategoriaController@update');
    Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
    Route::put('/categoria/activar', 'CategoriaController@activar');
    Route::put('/categoria/borrar', 'CategoriaController@borrar');

    /*ROLES*/
    Route::get('/tipousuario', 'TipousuarioController@index');
    Route::get('/tipousuario/selectRol', 'TipousuarioController@selectRol');

    /*USUARIOS*/
    Route::get('/usuario', 'UserController@index');
    Route::post('/usuario/registrar', 'UserController@store');
    Route::put('/usuario/actualizar', 'UserController@update');
    Route::put('/usuario/desactivar', 'UserController@desactivar');
    Route::put('/usuario/activar', 'UserController@activar');
    Route::put('/usuario/borrar', 'UserController@borrar');
/*++++++++++++++++++++++++++++++++++++++*/

/*TIENDA*/
Route::get('/shop', function () {
    return view('shop');
});
Auth::routes();

/*AUTH*/
//Route::get('/', 'Auth\LoginController@showLoginForm');
Route::post('/login', 'Auth\LoginController@login')->name('login');
/*******/

Route::get('/home', 'HomeController@index')->name('home');
