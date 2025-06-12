<?php
// app/Http/Controllers/InsumosController.php

namespace App\Http\Controllers;

use App\Models\Insumos;
use Illuminate\Http\Request;

class InsumosController extends Controller
{
    // Listar todos los insumos
    public function insumos(Request $request)
    {
        try {
            $todos = Insumos::all();
            if ($todos->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay insumos registrados',
                    'data'    => null
                ], 200);
            }

            $data = $todos->map(fn($i) => [
                'id'       => $i->id,
                'nombre'   => $i->nombre,
                'cantidad' => $i->cantidad,
                'unidad'   => $i->unidad,
            ]);

            return response()->json([
                'status'  => 200,
                'message' => 'Información de insumos obtenida correctamente',
                'data'    => $data
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Ocurrió un problema al listar insumos',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Insertar un nuevo insumo
    public function insertarInsumo(Request $request)
    {
        try {
            $datos = $request->validate([
                'nombre'   => 'required|string',
                'cantidad' => 'required|numeric|min:0',
                'unidad'   => 'required|string',
            ]);

            $insumo = Insumos::create($datos);

            return response()->json([
                'status'  => 200,
                'message' => 'Insumo creado correctamente',
                'data'    => $insumo
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
                'message' => 'Error al crear el insumo',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Actualizar un insumo existente
    public function actualizarInsumo(Request $request)
    {
        try {
            $datos = $request->validate([
                'id'       => 'required|integer|exists:insumos,id',
                'nombre'   => 'sometimes|required|string',
                'cantidad' => 'sometimes|required|numeric|min:0',
                'unidad'   => 'sometimes|required|string',
            ]);

            $insumo = Insumos::find($datos['id']);
            $insumo->update($request->only(['nombre','cantidad','unidad']));

            return response()->json([
                'status'  => 200,
                'message' => 'Insumo actualizado correctamente',
                'data'    => $insumo
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
                'message' => 'Error al actualizar el insumo',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Eliminar un insumo
    public function eliminarInsumo(Request $request)
    {
        try {
            $datos = $request->validate([
                'id' => 'required|integer|exists:insumos,id',
            ]);

            $insumo = Insumos::find($datos['id']);
            $insumo->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Insumo eliminado correctamente',
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
                'message' => 'Error al eliminar el insumo',
                'error'   => $th->getMessage()
            ], 300);
        }
    }
}
