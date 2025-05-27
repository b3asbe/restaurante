<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
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

//Listar
Route::get('productos',[ProductoController::class,'productos']);

//Insertar
Route::get('productos/insertar', [ProductoController::class, 'insertarProducto']);

//Actualizar
Route::get('productos/actualizar/{id}', [ProductoController::class, 'actualizarProducto']);

//Eliminar
Route::get('productos/eliminar-producto/{id}', [ProductoController::class, 'eliminarProducto']);
