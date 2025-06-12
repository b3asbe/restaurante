<?php
// app/Http/Controllers/MovimientosInsumoController.php

namespace App\Http\Controllers;

use App\Models\MovimientosInsumo;
use Illuminate\Http\Request;

class MovimientosInsumoController extends Controller
{
    // Listar todos los movimientos de insumo
    public function movimientos(Request $request)
    {
        try {
            $todos = MovimientosInsumo::all();
            if ($todos->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay movimientos de insumo registrados',
                    'data'    => null
                ], 200);
            }

            $data = $todos->map(fn($m) => [
                'id'        => $m->id,
                'insumo_id' => $m->insumo_id,
                'cantidad'  => $m->cantidad,
                'tipo'      => $m->tipo,
                'fecha'     => $m->fecha,
            ]);

            return response()->json([
                'status'  => 200,
                'message' => 'Movimientos obtenidos correctamente',
                'data'    => $data
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Ocurrió un problema al listar los movimientos',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Insertar un nuevo movimiento de insumo
    public function insertarMovimiento(Request $request)
    {
        try {
            $datos = $request->validate([
                'insumo_id' => 'required|integer|exists:insumos,id',
                'cantidad'  => 'required|numeric|min:0',
                'tipo'      => 'required|string|in:ENTRADA,SALIDA',
                'fecha'     => 'required|date_format:Y-m-d H:i:s',
            ]);

            $mov = MovimientosInsumo::create($datos);

            return response()->json([
                'status'  => 200,
                'message' => 'Movimiento de insumo creado correctamente',
                'data'    => $mov
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
                'message' => 'Error al crear el movimiento de insumo',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Actualizar un movimiento de insumo existente
    public function actualizarMovimiento(Request $request)
    {
        try {
            $datos = $request->validate([
                'id'        => 'required|integer|exists:movimientos_insumo,id',
                'insumo_id' => 'sometimes|required|integer|exists:insumos,id',
                'cantidad'  => 'sometimes|required|numeric|min:0',
                'tipo'      => 'sometimes|required|string|in:ENTRADA,SALIDA',
                'fecha'     => 'sometimes|required|date_format:Y-m-d H:i:s',
            ]);

            $mov = MovimientosInsumo::find($datos['id']);
            $mov->update($request->only(['insumo_id','cantidad','tipo','fecha']));

            return response()->json([
                'status'  => 200,
                'message' => 'Movimiento de insumo actualizado correctamente',
                'data'    => $mov
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
                'message' => 'Error al actualizar el movimiento',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Eliminar un movimiento de insumo
    public function eliminarMovimiento(Request $request)
    {
        try {
            $datos = $request->validate([
                'id' => 'required|integer|exists:movimientos_insumo,id',
            ]);

            $mov = MovimientosInsumo::find($datos['id']);
            $mov->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Movimiento de insumo eliminado correctamente',
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
                'message' => 'Error al eliminar el movimiento',
                'error'   => $th->getMessage()
            ], 300);
        }
    }
}
