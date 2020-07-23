<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');


});
Route::get('/usuario', 'AuthController@getUsers');
Route::get('/reserva/{id_taller}/taller/{mes}/mes', 'ReservaController@reservasByTaller');
//reservasByTalleres
Route::apiResource('/taller','TallerController');
Route::apiResource('/talleruser','TallerUserController');
Route::apiResource('/reserva','ReservaController');
Route::put('/usuario/{id}', 'AuthController@updateUser');
Route::any('prueba','ReservaController@enviarNotificacion' );
//mapa de ayuda
Route::apiResource('/mapa','MapaController');
Route::get('/busqueda/{id}','MapaController@buscar');
//presupeusto
Route::get('/buscarcuenta/{id}','UsersController@buscarcuenta');
Route::get('/buscarpatente/{id}','VehiculoController@buscarauto');
Route::apiResource('/crearvehiculo','VehiculoController');
Route::apiResource('/crearcotizacion','cotizacionController');
Route::apiResource('/crearboleta','boletaController');
//historial
Route::get('/historial/{id}','HistorialController@historial');
Route::get('/detalleboleta/{id}','HistorialController@detalle');
//reparacion
Route::apiResource('/crearreparacion','ReparacionController');
Route::get('/reparacionesadm', 'ReparacionController@getReparaciones');
Route::get('/detallereparacion/{id}','ReparacionController@detalle');
Route::put('/estado/{id}', 'ReparacionController@updateReparacion');








