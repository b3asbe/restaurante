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
use App\Http\Controllers\MesasController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\ProductosMenusController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\PedidoProductosController;
use App\Http\Controllers\OrganigramaController;
use App\Http\Controllers\RolesController;
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

//1: Productos CRUD


Route::post('productos/listar',      [ProductoController::class, 'productos']);
Route::post('productos/insertar',    [ProductoController::class, 'insertarProducto']);
Route::post('productos/actualizar',  [ProductoController::class, 'actualizarProducto']);
Route::post('productos/eliminar',    [ProductoController::class, 'eliminarProducto']);


// Listar
Route::post('usuarios/listar',     [UsuarioController::class, 'usuarios']);
Route::post('usuarios/insertar',   [UsuarioController::class, 'insertarUsuario']);
Route::post('usuarios/actualizar', [UsuarioController::class, 'actualizarUsuario']);
Route::post('usuarios/eliminar',   [UsuarioController::class, 'eliminarUsuario']);


//Insumos CRUD
Route::post('insumos/listar',     [InsumosController::class, 'insumos']);
Route::post('insumos/insertar',   [InsumosController::class, 'insertarInsumo']);
Route::post('insumos/actualizar', [InsumosController::class, 'actualizarInsumo']);
Route::post('insumos/eliminar',   [InsumosController::class, 'eliminarInsumo']);

//Menus CRUD



Route::post('menus/listar',     [MenusController::class, 'menus']);
Route::post('menus/insertar',   [MenusController::class, 'insertarMenu']);
Route::post('menus/actualizar', [MenusController::class, 'actualizarMenu']);
Route::post('menus/eliminar',   [MenusController::class, 'eliminarMenu']);


//Promociones CRUD

Route::post('promociones/listar',      [PromocionesController::class, 'promociones']);
Route::post('promociones/insertar',    [PromocionesController::class, 'insertarPromocion']);
Route::post('promociones/actualizar',  [PromocionesController::class, 'actualizarPromocion']);
Route::post('promociones/eliminar',    [PromocionesController::class, 'eliminarPromocion']);


//CRUD ESTADO_PEDIDOS
Route::post('estado-pedidos/listar',     [EstadoPedidosController::class, 'pedidos']);
Route::post('estado-pedidos/insertar',   [EstadoPedidosController::class, 'insertarPedido']);
Route::post('estado-pedidos/actualizar', [EstadoPedidosController::class, 'actualizarPedido']);
Route::post('estado-pedidos/eliminar',   [EstadoPedidosController::class, 'eliminarPedido']);


//CRUD RESERVAS

Route::post('reservas/listar',     [ReservasController::class, 'reservas']);
Route::post('reservas/insertar',   [ReservasController::class, 'insertarReserva']);
Route::post('reservas/actualizar', [ReservasController::class, 'actualizarReserva']);
Route::post('reservas/eliminar',   [ReservasController::class, 'eliminarReserva']);


//CRUD Movimientos Insumo



// Listar todos los movimientos de insumo
Route::post('movimientos-insumo/listar',     [MovimientosInsumoController::class, 'movimientos']);
Route::post('movimientos-insumo/insertar',   [MovimientosInsumoController::class, 'insertarMovimiento']);
Route::post('movimientos-insumo/actualizar', [MovimientosInsumoController::class, 'actualizarMovimiento']);
Route::post('movimientos-insumo/eliminar',   [MovimientosInsumoController::class, 'eliminarMovimiento']);



Route::post('mesas/listar',     [MesasController::class, 'mesas']);
Route::post('mesas/insertar',   [MesasController::class, 'insertarMesa']);
Route::post('mesas/actualizar', [MesasController::class, 'actualizarMesa']);
Route::post('mesas/eliminar',   [MesasController::class, 'eliminarMesa']);




Route::post('caja/listar',         [CajaController::class, 'cierresCaja']);
Route::post('caja/por-fecha',      [CajaController::class, 'cierresPorFecha']);



Route::post('productos-menus/listar',     [ProductosMenusController::class, 'relaciones']);
Route::post('productos-menus/insertar',   [ProductosMenusController::class, 'insertarRelacion']);
Route::post('productos-menus/actualizar', [ProductosMenusController::class, 'actualizarRelacion']);
Route::post('productos-menus/eliminar',   [ProductosMenusController::class, 'eliminarRelacion']);




Route::post('pedidos/listar',     [PedidosController::class, 'pedidos']);
Route::post('pedidos/insertar',   [PedidosController::class, 'insertarPedido']);
Route::post('pedidos/actualizar', [PedidosController::class, 'actualizarPedido']);
Route::post('pedidos/eliminar',   [PedidosController::class, 'eliminarPedido']);




Route::post('pedido-productos/listar',     [PedidoProductosController::class, 'relaciones']);
Route::post('pedido-productos/insertar',   [PedidoProductosController::class, 'insertarRelacion']);
Route::post('pedido-productos/actualizar', [PedidoProductosController::class, 'actualizarRelacion']);
Route::post('pedido-productos/eliminar',   [PedidoProductosController::class, 'eliminarRelacion']);



// Listar todos los puestos del organigrama
Route::get('organigrama', [OrganigramaController::class, 'organigramas']);
Route::get('organigrama/insertar/{id}/{nombre}', [OrganigramaController::class, 'insertarOrganigrama']);
Route::get('organigrama/actualizar/{id}/{padre}/{nombre}', [OrganigramaController::class, 'actualizarOrganigrama']);
Route::get('organigrama/eliminar/{id}', [OrganigramaController::class, 'eliminarOrganigrama']);
Route::get('organigrama/ver', [OrganigramaController::class, 'verOrganigrama']);



// Roles CRUD
Route::post('roles/listar',     [RolesController::class, 'roles']);
Route::post('roles/insertar',   [RolesController::class, 'insertarRole']);
Route::post('roles/actualizar', [RolesController::class, 'actualizarRole']);
Route::post('roles/eliminar',   [RolesController::class, 'eliminarRole']);