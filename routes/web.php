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


//  Route::get('/', function () {
//         return view('funciona');
//     });
    

Route::group(['middleware' => ['guest']], function () {
    Auth::routes();
     Route::get('/', function () {
        return view('presentacion/inicio');
    });
    Route::get('/Ingresar','Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
});

Route::group(['middleware' => ['auth']], function () {

    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

        Route::group(['middleware' => ['Cliente']], function () {
        Route::get('/categoria','CategoriaController@index');
        Route::post('/categoria/registrar','CategoriaController@store');
        Route::put('/categoria/actualizar','CategoriaController@update');
        Route::put('/categoria/desactivar','CategoriaController@desactivar');
        Route::put('/categoria/activar','CategoriaController@activar');
        Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');
    
        Route::get('/producto', 'ProductoController@index');
        Route::post('/producto/registrar', 'ProductoController@store');
        Route::put('/producto/actualizar', 'ProductoController@update');
        Route::put('/producto/desactivar', 'ProductoController@desactivar');
        Route::put('/producto/activar', 'ProductoController@activar');
        Route::get('/producto/buscarProducto', 'ProductoController@buscarProducto');
        Route::get('/producto/listarProducto', 'ProductoController@listarProducto');
        Route::get('/producto/listarPdf', 'ProductoController@listarPdf')->name('productos_pdf');
    
        Route::get('/proveedor', 'ProveedorController@index');
        Route::post('/proveedor/registrar', 'ProveedorController@store');
        Route::put('/proveedor/actualizar', 'ProveedorController@update');
        Route::get('/proveedor/selectProveedor', 'ProveedorController@selectProveedor');

        Route::get('/arbol', 'ArbolController@index');

        Route::get('/get_users', 'MessageController@getUsers');
        Route::get('/get_messages', 'MessageController@getMessages');
        Route::post('notifications', 'MessageController@sendMail');
        
   
   
    });


        Route::group(['middleware' => ['Mecanico']], function () {
        Route::get('/categoria','CategoriaController@index');
        Route::post('/categoria/registrar','CategoriaController@store');
        Route::put('/categoria/actualizar','CategoriaController@update');
        Route::put('/categoria/desactivar','CategoriaController@desactivar');
        Route::put('/categoria/activar','CategoriaController@activar');
        Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');
    
        Route::get('/producto', 'ProductoController@index');
        Route::post('/producto/registrar', 'ProductoController@store');
        Route::put('/producto/actualizar', 'ProductoController@update');
        Route::put('/producto/desactivar', 'ProductoController@desactivar');
        Route::put('/producto/activar', 'ProductoController@activar');
        Route::get('/producto/buscarProducto', 'ProductoController@buscarProducto');
        Route::get('/producto/listarProducto', 'ProductoController@listarProducto');
        Route::get('/producto/listarPdf', 'ProductoController@listarPdf')->name('productos_pdf');
        Route::get('/cliente', 'ClienteController@index');
        Route::get('/historial', 'HistorialController@index');
        Route::get('/historialcliente', 'HistorialController@indexcliente');
        Route::get('/historial/cotizaciones', 'HistorialController@cotizaciones');
        Route::get('/historial/cotizacionescliente', 'HistorialController@cotizacionescliente');


        Route::post('/cliente/registrar', 'ClienteController@store');
        Route::put('/cliente/actualizar', 'ClienteController@update');
        Route::get('/cliente/selectCliente', 'ClienteController@selectCliente');

        Route::get('/mapa', 'ArbolController@index');
        Route::get('/mapa/busqueda/{id}', 'ArbolController@buscar');

        Route::get('/vehiculo', 'VehiculoController@index');
        Route::post('/vehiculo/registrar', 'VehiculoController@store');
        Route::get('/vehiculo/selectVehiculo', 'VehiculoController@selectVehiculo');

        Route::get('/taller/mecanico', 'TallerController@tallermecanico');


        Route::get('/get_users', 'MessageController@getUsers');
Route::get('/get_messages', 'MessageController@getMessages');
Route::post('notifications', 'MessageController@sendMail');

    });


            Route::group(['middleware' => ['Administrador']], function () {
            Route::get('/categoria','CategoriaController@index');
            Route::post('/categoria/registrar','CategoriaController@store');
            Route::put('/categoria/actualizar','CategoriaController@update');
            Route::put('/categoria/desactivar','CategoriaController@desactivar');
            Route::put('/categoria/activar','CategoriaController@activar');
            Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');
        
            Route::get('/producto', 'ProductoController@index');
            Route::post('/producto/registrar', 'ProductoController@store');
            Route::put('/producto/actualizar', 'ProductoController@update');
            Route::put('/producto/desactivar', 'ProductoController@desactivar');
            Route::put('/producto/activar', 'ProductoController@activar');
            Route::get('/producto/buscarProducto', 'ProductoController@buscarProducto');
            Route::get('/producto/listarProducto', 'ProductoController@listarProducto');
            Route::get('/producto/listarPdf', 'ProductoController@listarPdf')->name('productos_pdf');
        
            Route::get('/proveedor', 'ProveedorController@index');
            Route::post('/proveedor/registrar', 'ProveedorController@store');
            Route::put('/proveedor/actualizar', 'ProveedorController@update');
            Route::get('/proveedor/selectProveedor', 'ProveedorController@selectProveedor');

            Route::post('/cliente/registrar', 'ClienteController@store');
            Route::put('/cliente/actualizar', 'ClienteController@update');
            Route::get('/cliente/selectCliente', 'ClienteController@selectCliente');

            Route::get('/rol', 'RolController@index');
            Route::get('/rol/selectRol', 'RolController@selectRol');
            
            Route::get('/user', 'UserController@index');
            Route::post('/user/registrar', 'UserController@store');
            Route::put('/user/actualizar', 'UserController@update');
            Route::put('/user/desactivar', 'UserController@desactivar');
            Route::put('/user/activar', 'UserController@activar');

            Route::put('/vehiculo/desactivar', 'VehiculoController@desactivar');
            Route::put('/vehiculo/activar', 'VehiculoController@activar');

            Route::put('/cliente/desactivar', 'ClienteController@desactivar');
            Route::put('/cliente/activar', 'ClienteController@activar');

            Route::get('/user/selectUser', 'userController@selectUser');


            Route::get('/taller', 'TallerController@index');
            Route::post('/taller/registrar', 'TallerController@store');
            Route::put('/taller/actualizar', 'TallerController@update');
            Route::get('/taller/selectTaller', 'TallerController@selectTaller');
            
            Route::get('/mapa', 'ArbolController@index');

            Route::get('/TallerUser', 'TallerUserController@index');
            Route::post('/TallerUser/registrar', 'TallerUserController@store');

            Route::post('/vehiculo/registrar', 'VehiculoController@store');
            Route::put('/vehiculo/actualizar', 'VehiculoController@update');
            Route::get('/vehiculo/selectCliente', 'VehiculoController@selectVehiculo');

            Route::post('/cotizacion/registrar', 'CotizacionController@store');
            Route::post('/reparacion/registrar', 'ReparacionController@store');
            Route::get('/reparacion/prueba', 'ReparacionController@index');

            Route::get('/reparacion/reparacionesadm', 'ReparacionController@getReparaciones');
            Route::get( '/reparacion/detallereparacion/{id}', 'ReparacionController@detalle');
            Route::get( '/detallereparacion', 'ReparacionController@detallereparacion');
            Route::get( '/detallecotizacion', 'ReparacionController@detallecotizacion');
            Route::get( '/detallecotizacioncliente', 'ReparacionController@detallecotizacioncliente');

            Route::put('/reparacion/estado/{id}', 'ReparacionController@updateReparacion');
            Route::get('/reparacion', 'ReparacionController@index');
            
            Route::get('/historial/buscar/{id}','HistorialController@historial');
            Route::get('/historial/detalleboleta/{id}','HistorialController@detalle');


           
            Route::get('/get_users', 'MessageController@getUsers');
            Route::get('/get_messages', 'MessageController@getMessages');
            Route::post('notifications', 'MessageController@sendMail');

    
    });

});