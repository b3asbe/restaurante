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

//Listar
Route::get('productos',[ProductoController::class,'productos']);
//Insertar
Route::post('productos/insertar', [ProductoController::class, 'insertarProducto']);
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




// Listar todas las mesas
Route::get('mesas', [MesasController::class, 'mesas']);

// Insertar una nueva mesa
Route::get('mesas/insertar/{id}', [MesasController::class, 'insertarMesa']);

// Actualizar mesa por ID
Route::get('mesas/actualizar/{id}', [MesasController::class, 'actualizarMesa']);

// Eliminar mesa por ID
Route::get('mesas/eliminar/{id}', [MesasController::class, 'eliminarMesa']);





// Listar todos los cierres de caja
Route::get('cierres_caja', [CajaController::class, 'cierresCaja']);


Route::get('cierres_caja/fecha/{fecha}', [CajaController::class, 'cierresPorFecha']);



// Listar todas las relaciones menú‐producto
Route::get('productos_menus', [ProductosMenusController::class, 'relaciones']);

// Insertar nueva relación (ejemplo con valores estáticos)
Route::get('productos_menus/insertar', [ProductosMenusController::class, 'insertarRelacion']);

// Actualizar relación existente (requiere menuId y productoId originales)
Route::get('productos_menus/actualizar/{menuId}/{productoId}', [ProductosMenusController::class, 'actualizarRelacion']);




// Listar todos los pedidos
Route::get('pedidos', [PedidosController::class, 'pedidos']);

// Insertar un nuevo pedido
Route::get('pedidos/insertar', [PedidosController::class, 'insertarPedido']);

// Actualizar un pedido existente (requiere ID)
Route::get('pedidos/actualizar/{id}', [PedidosController::class, 'actualizarPedido']);

// Eliminar un pedido (requiere ID)
Route::get('pedidos/eliminar/{id}', [PedidosController::class, 'eliminarPedido']);




// Listar todas las relaciones pedido‐producto
Route::get('pedido_productos', [PedidoProductosController::class, 'relaciones']);

// Insertar nueva relación (ejemplo con valores estáticos)
Route::get('pedido_productos/insertar', [PedidoProductosController::class, 'insertarRelacion']);

// Actualizar relación existente (requiere pedidoId y productoId originales)
Route::get('pedido_productos/actualizar/{pedidoId}/{productoId}', [PedidoProductosController::class, 'actualizarRelacion']);

// Eliminar relación (requiere pedidoId y productoId)
Route::get('pedido_productos/eliminar/{pedidoId}/{productoId}', [PedidoProductosController::class, 'eliminarRelacion']);




// Listar todos los puestos del organigrama
Route::get('organigrama', [OrganigramaController::class, 'organigramas']);

// Insertar un nuevo puesto en el organigrama
Route::get('organigrama/insertar/{id}/{nombre}', [OrganigramaController::class, 'insertarOrganigrama']);

// Actualizar un puesto existente (requiere ID)
Route::get('organigrama/actualizar/{id}/{padre}/{nombre}', [OrganigramaController::class, 'actualizarOrganigrama']);

// Eliminar un puesto (requiere ID)
Route::get('organigrama/eliminar/{id}', [OrganigramaController::class, 'eliminarOrganigrama']);


Route::get('organigrama/ver', [OrganigramaController::class, 'verOrganigrama']);



// Roles CRUD
Route::get('roles', [RolesController::class, 'roles']);
Route::get('roles/insertar', [RolesController::class, 'insertarRole']);
Route::get('roles/actualizar/{id}', [RolesController::class, 'actualizarRole']);
Route::get('roles/eliminar/{id}', [RolesController::class, 'eliminarRole']);
