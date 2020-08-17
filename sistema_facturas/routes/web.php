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
    Route::get('/', function () {
        return view('welcome');
    });

    
    Route::get('/busqueda', 'BusquedaController@index');
    Route::get('/sociedad/selectSociedadP', 'SociedadController@selectRolPublic');

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

    /*REPORTES*/
    Route::get('/reporte', 'ReporteController@index');
    Route::put('/reporte/borrar', 'ReporteController@borrar');

    /*FACTURAS*/
    Route::get('/factura', 'FacturaController@index');
    Route::post('/factura/registrar', 'FacturaController@store');
    Route::get('/factura/descargarPDF', 'FacturaController@downloadPDF');
    Route::put('/factura/borrar', 'FacturaController@borrar');

    /*SOCIEDADES*/
    Route::get('/sociedad', 'SociedadController@index');
    Route::post('/sociedad/registrar', 'SociedadController@store');
    Route::put('/sociedad/actualizar', 'SociedadController@update');
    Route::put('/sociedad/borrar', 'SociedadController@borrar');
    Route::get('/sociedad/selectSociedad', 'SociedadController@selectRol');

    /*USUARIOS*/
    Route::get('/usuario', 'UserController@index');
    Route::post('/usuario/registrar', 'UserController@store');
    Route::put('/usuario/actualizar', 'UserController@update');
    Route::put('/usuario/desactivar', 'UserController@desactivar');
    Route::put('/usuario/activar', 'UserController@activar');
    Route::put('/usuario/borrar', 'UserController@borrar');

    /*CERRAR SESION*/
    Route::get('/login', 'Auth\LoginController@logout')->name('logout');

});
//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
