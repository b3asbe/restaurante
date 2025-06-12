<?php
// app/Http/Controllers/MenusController.php

namespace App\Http\Controllers;

use App\Models\Menus;
use Illuminate\Http\Request;

class MenusController extends Controller
{
    // Listar todos los menús
    public function menus(Request $request)
    {
        try {
            $todos = Menus::all();
            if ($todos->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay menús registrados',
                    'data'    => null
                ], 200);
            }

            $data = $todos->map(fn($m) => [
                'id'          => $m->id,
                'nombre'      => $m->nombre,
                'descripcion' => $m->descripcion,
            ]);

            return response()->json([
                'status'  => 200,
                'message' => 'Menús obtenidos correctamente',
                'data'    => $data
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al listar los menús',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Insertar un nuevo menú
    public function insertarMenu(Request $request)
    {
        try {
            $datos = $request->validate([
                'nombre'      => 'required|string|unique:menus,nombre',
                'descripcion' => 'required|string',
            ]);

            $menu = Menus::create($datos);

            return response()->json([
                'status'  => 200,
                'message' => 'Menú creado correctamente',
                'data'    => $menu
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status'  => 422,
                'message' => 'Datos inválidos',
                'errors'  => $e->errors()
            ], 422);

        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al crear el menú',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Actualizar un menú existente
    public function actualizarMenu(Request $request)
    {
        try {
            $datos = $request->validate([
                'id'          => 'required|integer|exists:menus,id',
                'nombre'      => 'sometimes|required|string|unique:menus,nombre,'.$request->id,
                'descripcion' => 'sometimes|required|string',
            ]);

            $menu = Menus::find($datos['id']);
            $menu->update($request->only(['nombre','descripcion']));

            return response()->json([
                'status'  => 200,
                'message' => 'Menú actualizado correctamente',
                'data'    => $menu
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status'  => 422,
                'message' => 'Datos inválidos',
                'errors'  => $e->errors()
            ], 422);

        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al actualizar el menú',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Eliminar un menú
    public function eliminarMenu(Request $request)
    {
        try {
            $datos = $request->validate([
                'id' => 'required|integer|exists:menus,id',
            ]);

            $menu = Menus::find($datos['id']);
            $menu->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Menú eliminado correctamente',
                'data'    => null
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status'  => 422,
                'message' => 'ID inválido',
                'errors'  => $e->errors()
            ], 422);

        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al eliminar el menú',
                'error'   => $th->getMessage()
            ], 300);
        }
    }
}
