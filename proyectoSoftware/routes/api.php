<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VentaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Estas rutas devuelven JSON para consumo desde el frontend Angular.
|
*/

// Productos
Route::get('/productos', [ProductoController::class, 'apiIndex']);
Route::get('/productos/{id}', [ProductoController::class, 'apiShow']);
Route::post('/productos', [ProductoController::class, 'apiStore']);
Route::post('/productos/batch', [ProductoController::class, 'apiBatchStore']);
Route::put('/productos/{id}', [ProductoController::class, 'apiUpdate']);
Route::delete('/productos/{id}', [ProductoController::class, 'apiDestroy']);

// Proveedores
Route::get('/proveedores', [ProveedorController::class, 'apiIndex']);
Route::get('/proveedores/{id}', [ProveedorController::class, 'apiShow']);
Route::post('/proveedores', [ProveedorController::class, 'apiStore']);
Route::put('/proveedores/{id}', [ProveedorController::class, 'apiUpdate']);
Route::delete('/proveedores/{id}', [ProveedorController::class, 'apiDestroy']);

// Clientes
Route::get('/clientes', [ClienteController::class, 'apiIndex']);
Route::get('/clientes/{id}', [ClienteController::class, 'apiShow']);
Route::post('/clientes', [ClienteController::class, 'apiStore']);
Route::put('/clientes/{id}', [ClienteController::class, 'apiUpdate']);
Route::delete('/clientes/{id}', [ClienteController::class, 'apiDestroy']);

// Ventas
Route::get('/ventas', [VentaController::class, 'apiIndex']);
Route::get('/ventas/{id}', [VentaController::class, 'apiShow']);
Route::post('/ventas', [VentaController::class, 'apiStore']);
Route::put('/ventas/{id}', [VentaController::class, 'apiUpdate']);
Route::delete('/ventas/{id}', [VentaController::class, 'apiDestroy']);

// Movimientos de Inventario
Route::get('/movimientos', [\App\Http\Controllers\MovimientoInventarioController::class, 'apiIndex']);
Route::get('/movimientos/{id}', [\App\Http\Controllers\MovimientoInventarioController::class, 'apiShow']);
Route::post('/movimientos', [\App\Http\Controllers\MovimientoInventarioController::class, 'apiStore']);
Route::put('/movimientos/{id}', [\App\Http\Controllers\MovimientoInventarioController::class, 'apiUpdate']);
Route::delete('/movimientos/{id}', [\App\Http\Controllers\MovimientoInventarioController::class, 'apiDestroy']);