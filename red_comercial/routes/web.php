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

/*CUALQUIER USUARIO*/
Route::group(['middleware' => ['guest']], function () {
    /*PAGINA DE BUSQUEDA*/
    Route::get('/', function () {
        return view('welcome');
    });

    /*TIENDA*/
    Route::get('/shop', function () {
        return view('shop');
    });

    /*AUTH*/
    Route::get('/sh-login', 'Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
});


/*USUARIOS LOGEADOS*/
Route::group(['middleware' => ['auth']], function () {

    /*CONTENIDO DE DASHBOARD*/
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    /*CERRAR SESION*/
    Route::get('/login', 'Auth\LoginController@logout')->name('logout');


    /*ADMINISTRADOR*/
    Route::group(['middleware' => ['Administrador']], function () {

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

        /*PERFIL DE USUARIO*/
        Route::get('/perfil', 'PerfilController@index');

        /*++++++++++++++++++++++++++++++++++++++*/

    });
    /*=============*/

    /*VENDEDOR*/
    Route::group(['middleware' => ['Vendedor']], function () {

        /*PERFIL DE USUARIO*/
        Route::get('/perfil', 'PerfilController@index');
    });
    /*=============*/

    /*CLIENTE*/
    /*=============*/

});

Route::get('/home', 'HomeController@index')->name('home');
