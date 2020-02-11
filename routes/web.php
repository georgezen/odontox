<?php




Route::get('/', function () {
	return View::make('home');
});
//Route::get('trabajadores', 'Trabajador@trabajadores')->name('trabajadores');
// las rutas tipo resources permiten simplificar el pedote de la linea anterior

//Grupo rutas para el admin
Route::group(['middleware' => ['auth', 'admin']], function () {

	Route::resource('sucursales', 'SucursalesController');
	Route::get('/edit_sucursal', 'SucursalesController@edit')->name('edit_sucursal');
	Route::post('/update_sucursal', 'SucursalesController@update')->name('update_sucursal');
	Route::post('/delete_sucursal', 'SucursalesController@destroy')->name('delete_sucursal');


	Route::resource('trabajadores', 'TrabajadoresController');
	Route::post('/add_trabajador', 'TrabajadoresController@store')->name('add_trabajador');
	Route::get('/edit_trabajador', 'TrabajadoresController@edit')->name('edit_trabajador');
	Route::post('/update_trabajador', 'TrabajadoresController@update')->name('update_trabajador');
	Route::post('/delete_trabajador', 'TrabajadoresController@destroy')->name('delete_trabajador');
	Route::get('/ajax/trabajadores/','TrabajadoresController@loadPage' );

	Route::resource('usuarios', 'UsuariosController');

	Route::get('presentacionProducto', 'PresentacionProductoController@index')->name('presentacionProducto');
	Route::post('/add_presentacion', 'PresentacionProductoController@store')->name('add_presentacion');
	Route::get('/edit_presentacion', 'PresentacionProductoController@edit')->name('edit_presentacion');
	Route::post('/update_presentacion', 'PresentacionProductoController@update')->name('update_presentacion');
	Route::get('/ajax/presentacion/','PresentacionProductoController@loadPage' );



	Route::get('roles', 'rolesController@index')->name('roles');
	Route::get('read_roles', 'rolesController@read_roles')->name('read_roles');
	Route::post('/save_roles', 'rolesController@store')->name('save_roles');
	Route::get('/edit_rol', 'rolesController@edit')->name('edit_rol');
	Route::post('/update_rol', 'rolesController@update')->name('update_role');
	Route::post('/delete_rol', 'rolesController@destroy')->name('delete_role');

//rutas para producto
	Route::get('productos', 'Productos_controller@index')->name('productos');
	Route::get('/read_productos', 'Productos_controller@read')->name('read_productos');
	Route::post('/save_producto', 'Productos_controller@store')->name('save_producto');
	Route::post('/upload_image', 'Productos_controller@upload_image')->name('upload_image');
	Route::get('/load_id', 'Productos_controller@load_id')->name('load_id');
	Route::get('/edit_producto', 'Productos_controller@edit_producto')->name('edit_producto');
	Route::post('/update_producto', 'Productos_controller@update_producto')->name('update_producto');
	Route::post('/off_producto', 'Productos_controller@off_producto')->name('off_producto');
	Route::get('/ajax/producto/','Productos_controller@loadPage' );
	Route::get('/ajax/filtrar_productos/','Productos_controller@filter');

//fin rutas para producto

//Ventas rutas
	Route::get('/ventas', 'ventasController@index')->name('ventas');
	Route::get('/add_venta', 'ventasController@create')->name('add_venta');
	Route::post('/guardar_venta', 'ventasController@store')->name('guardar_venta');
	Route::post('/insert_detalle_venta', 'ventasController@insert_detalle_venta')->name('insert_detalle_venta');
	Route::get('/get_info_producto', 'ventasController@get_info_producto')->name('get_info_producto');
	Route::get('/load_id_detalle_venta', 'ventasController@load_id_detalle_venta')->name('load_id_detalle_venta');
	Route::get('/ajax/ventas/','ventasController@loadPage' );
	Route::get('/ajax/filtrar_ventas/','ventasController@filter');

	
// fin Ventas rutas	

// rutas proveedores 
	Route::get('/proveedores', 'Proveedores_controller@index')->name('proveedores');
	Route::post('/save_proveedor', 'Proveedores_controller@store')->name('save_proveedor');
	Route::get('/ajax/proveedor/','Proveedores_controller@loadPage' );
	Route::get('/edit_proveedor', 'Proveedores_controller@edit')->name('edit_proveedor');
	Route::post('/update_proveedor', 'Proveedores_controller@update')->name('update_proveedor');
	Route::post('/delete_proveedor', 'Proveedores_controller@destroy')->name('delete_proveedor');
	Route::get('/ajax/filtrar_proveedores/','Proveedores_controller@filter');
	
//fin rutas proveedores 

// rutas compras 
	Route::get('/compras', 'comprasController@index')->name('compras');
	Route::post('/guardar_compra', 'comprasController@store')->name('guardar_compra');
	Route::post('/insert_detalle_compra', 'comprasController@insert_detalle_compra')->name('insert_detalle_compra');
	Route::get('/add_compra', 'comprasController@create')->name('add_compra');
	Route::get('/cancelar_compra', function(){
		return view('compras.index');	
	})->name('cancelar_compra');
	Route::get('/ajax/compras/','comprasController@loadPage' );
	Route::get('/load_id_detalle_compra','comprasController@show' )->name('load_id_detalle_compra');
	Route::get('/ajax/filtrar_compras/','comprasController@filter');
// fin rutas compras 


//rutas para crud clientes	
	Route::get('/clientes', 'clientesController@index')->name('clientes');
	Route::post('/save_cliente', 'clientesController@store')->name('save_cliente');
	Route::get('/ajax/cliente/','clientesController@loadPage' );
	Route::get('/edit_cliente', 'clientesController@edit')->name('edit_cliente');
	Route::post('/update_cliente', 'clientesController@update')->name('update_cliente');
	Route::post('/delete_cliente', 'clientesController@destroy')->name('delete_cliente');
	Route::get('/ajax/filtrar_clientes/','clientesController@filter');

//fin rutas para crud clientes	

// rutas para modulo de almacen
	Route::get('/almacen', 'Almacen_controller@show')->name('almacen');
	Route::get('/ajax/producto2/','Almacen_controller@loadPage' );
	Route::get('/ajax/filtrar_productos2/','Almacen_controller@filter');
//fin  rutas para modulo de almacen


	Route::get('/reporte_almacen','ReportesPdf@index')->name('reportes');

});	
// Fin Grupo rutas para el admin

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/checar', 'HomeController@checar')->name('checar');
Route::get('/login', function () {
	return view('auth.login');
})->name('login');







