<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\InsumosController;
use App\Http\Controllers\MenusController;
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
