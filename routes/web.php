<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\InsumosController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\PromocionesController;
use App\Http\Controllers\EstadoPedidosController;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\MovimientosInsumoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Productos CRUD

//Listar
Route::get('productos',[ProductoController::class,'productos']);
//Insertar
Route::get('productos/insertar', [ProductoController::class, 'insertarProducto']);
//Actualizar
Route::get('productos/actualizar/{id}', [ProductoController::class, 'actualizarProducto']);
//Eliminar
Route::get('productos/eliminar-producto/{id}', [ProductoController::class, 'eliminarProducto']);


//Usuarios CRUD

// Listar
Route::get('usuarios', [UsuarioController::class, 'usuarios']);
// Insertar
Route::get('usuarios/insertar', [UsuarioController::class, 'insertarUsuario']);
// Actualizar
Route::get('usuarios/actualizar/{id}', [UsuarioController::class, 'actualizarUsuario']);
// Eliminar
Route::get('usuarios/eliminar/{id}', [UsuarioController::class, 'eliminarUsuario']);


//Insumos CRUD
// Listar 
Route::get('insumos', [InsumosController::class, 'insumos']);
// Insertar 
Route::get('insumos/insertar', [InsumosController::class, 'insertarInsumo']);
// Actualizar 
Route::get('insumos/actualizar/{id}', [InsumosController::class, 'actualizarInsumo']);
// Eliminar 
Route::get('insumos/eliminar/{id}', [InsumosController::class, 'eliminarInsumo']);


//Menus CRUD

// Listar 
Route::get('menus', [MenusController::class, 'menus']);
// Insertar 
Route::get('menus/insertar', [MenusController::class, 'insertarMenu']);
// Actualizar 
Route::get('menus/actualizar/{id}', [MenusController::class, 'actualizarMenu']);
// Eliminar 
Route::get('menus/eliminar/{id}', [MenusController::class, 'eliminarMenu']);


//Promociones CRUD
// Listar todas las promociones
Route::get('promociones', [PromocionesController::class, 'promociones']);

// Insertar una promoción de ejemplo
Route::get('promociones/insertar', [PromocionesController::class, 'insertarPromocion']);

// Actualizar una promoción por ID
Route::get('promociones/actualizar/{id}', [PromocionesController::class, 'actualizarPromocion']);

// Eliminar una promoción por ID
Route::get('promociones/eliminar/{id}', [PromocionesController::class, 'eliminarPromocion']);

//CRUD ESTADO_PEDIDOS
// Listar todos los estados
Route::get('estado_pedidos', [EstadoPedidosController::class, 'pedidos']);

// Insertar (ejemplo hardcodeado)
Route::get('estado_pedidos/insertar', [EstadoPedidosController::class, 'insertarPedido']);

// Actualizar un estado por ID
Route::get('estado_pedidos/actualizar/{id}', [EstadoPedidosController::class, 'actualizarPedido']);

// Eliminar un estado por ID
Route::get('estado_pedidos/eliminar/{id}', [EstadoPedidosController::class, 'eliminarPedido']);


//CRUD RESERVAS

// Listar todas las reservas
Route::get('reservas', [ReservasController::class, 'reservas']);

// Insertar (ejemplo hardcodeado)
Route::get('reservas/insertar', [ReservasController::class, 'insertarReserva']);

// Actualizar una reserva por ID
Route::get('reservas/actualizar/{id}', [ReservasController::class, 'actualizarReserva']);

// Eliminar una reserva por ID
Route::get('reservas/eliminar/{id}', [ReservasController::class, 'eliminarReserva']);


//CRUD Movimientos Insumo



// Listar todos los movimientos de insumo
Route::get('movimientos-insumo', [MovimientosInsumoController::class, 'movimientos']);

// Insertar un movimiento de insumo (ejemplo hardcodeado)
Route::get('movimientos-insumo/insertar', [MovimientosInsumoController::class, 'insertarMovimiento']);

// Actualizar un movimiento por ID
Route::get('movimientos-insumo/actualizar/{id}', [MovimientosInsumoController::class, 'actualizarMovimiento']);

// Eliminar un movimiento por ID
Route::get('movimientos-insumo/eliminar/{id}', [MovimientosInsumoController::class, 'eliminarMovimiento']);
