<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;


/*
|--------------------------------------------------------------------------
| Rutas de ventas de la ferreteria
|--------------------------------------------------------------------------
*/

Route::controller(VentaController::class)->group(function(){
    Route::get('venta', 'index')->name('venta_index');
    Route::get('venta/create', 'create')->name('venta_create');
    Route::post('venta/store', 'store')->name('venta_store');

});

/*
|--------------------------------------------------------------------------
| Rutas de almacen (productos)x
|--------------------------------------------------------------------------
*/

Route::controller(AlmacenController::class)->group(function(){
    Route::get('almacen', 'index')->name('producto_index');           // Listar todos los productos en el almacén
    Route::get('almacen/create', 'create')->name('producto_create');   // Formulario para agregar un nuevo producto
    Route::post('almacen/store', 'store')->name('producto_store');    // Guardar un nuevo producto en la base de datos   
    Route::get('almacen/carrito', 'mostrarCarrito')->name('mostrar_carro');
    Route::post('almacen/agregar-al-carrito/{id}', 'agregarAlCarrito')->name('agregar_carro');
    Route::post('almacen/quitar-del-carrito/{id}', 'quitarDelCarrito')->name('quitar_carro');
    Route::get('almacen/show_all','show_all')->name('producto_show_all');
    Route::get('almacen/{id}', 'show')->name('producto_show');       // Ver detalles de un producto específico
    Route::get('almacen/{id}/edits', 'edit_get')->name('producto_get');  //obtenemos datos de producto
    Route::get('almacen/{id}/edit', 'edit')->name('producto_edit');  // Formulario para editar un producto
    Route::put('almacen/{id}', 'update')->name('producto_update');     // Actualizar un producto
    Route::get('almacen/destroy', 'destroy')->name('producto_destroy');
    Route::delete('almacen/{id}', 'delete'); // Eliminar un producto del almacén
});
 

/*
|--------------------------------------------------------------------------
| Rutas de proveedores de la ferreteria
|--------------------------------------------------------------------------
*/

Route::controller(ProveedorController::class)->group(function(){
    Route::get('proveedor', 'index')->name('proveedor_index');           // Listar todos los proveedores
    Route::get('proveedor/create', 'create')->name('proveedor_create');   // Formulario para agregar un nuevo proveedor
    Route::post('proveedor/store', 'store')->name('proveedor_store');    // Guardar un nuevo proveedor en la base de datos
    Route::get('proveedor/search','search')->name('search_proveedor');  // Formulario para ingresar RUC del proveedor
    Route::get('proveedor/show_all', 'show_all')->name('show_proveedor_all');       // Ver detalles de un proveedor específico
    Route::get('proveedor/show', 'show')->name('proveedor_show');       // Ver detalles de un proveedor específico
    Route::get('proveedor/search_edit', 'search_edit')->name('search_edit');  // Formulario para editar un proveedor
    Route::get('proveedor/edit', 'edit_get')->name('proveedor_get'); //obtenemos datos de proveedor
    Route::get('proveedor/{id}/edits','edit_get2')->name('proveedor_get2'); //obtenemos datos de proveedor
    Route::get('proveedor/{id}/edit', 'edit')->name('proveedor_edit');     // Formulario para editar un proveedor
    Route::put('proveedor/{id}', 'update')->name('proveedor_update');     // actualizamos al proveedor
    Route::get('proveedor/destroy', 'destroy')->name('proveedor_destroy'); 
    Route::get('proveedor/{id}/destroy', 'delete_get')->name('delete_get'); // obtenemos datos de proveedor
    Route::delete('proveedor/{id}','delete')->name('proveedor_delete'); //Eliminamos al proveedor
});


/*
|--------------------------------------------------------------------------
| Rutas de Clientes
|--------------------------------------------------------------------------
*/
Route::controller(ClienteController::class)->group(function(){

    Route::get('cliente', 'index')->name('cliente_index');
    Route::get('cliente/create', 'create')->name('cliente_create');
    Route::post('cliente/store', 'store')->name('cliente_store');
    Route::get('cliente/show_all', 'show_all')->name('show_cliente_all');
    Route::get('cliente/destroy', 'destroy_get')->name('cliente_destroy_get');
    Route::get('cliente/{id}/destroy', 'destroy')->name('cliente_destroy');
    Route::delete('cliente/{id}', 'delete')->name('cliente_delete');
});



/*
|--------------------------------------------------------------------------
| Página principal
|--------------------------------------------------------------------------
*/

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [LoginController::class, 'showLoginForm'])->name('custom_login');
Route::get('/home',HomeController::class)->name('home');
Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
