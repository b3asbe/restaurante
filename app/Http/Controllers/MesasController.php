<?php
// app/Http/Controllers/MesasController.php

namespace App\Http\Controllers;

use App\Models\Mesas;
use Illuminate\Http\Request;

class MesasController extends Controller
{
    // Listar todas las mesas
    public function mesas(Request $request)
    {
        try {
            $todas = Mesas::all();
            if ($todas->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay mesas registradas',
                    'data'    => null
                ], 200);
            }
            
            $data = $todas->map(fn($m) => [
                'id'        => $m->id,
                'numero'    => $m->numero,
                'capacidad' => $m->capacidad,
            ]);

            return response()->json([
                'status'  => 200,
                'message' => 'Mesas obtenidas correctamente',
                'data'    => $data
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al listar las mesas',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Insertar una nueva mesa
    public function insertarMesa(Request $request)
    {
        try {
            $datos = $request->validate([
                'numero'    => 'required|integer|unique:mesas,numero',
                'capacidad' => 'required|integer|min:1',
            ]);

            $mesa = Mesas::create($datos);

            return response()->json([
                'status'  => 200,
                'message' => 'Mesa creada correctamente',
                'data'    => $mesa
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
                'message' => 'Error al crear la mesa',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Actualizar una mesa existente
    public function actualizarMesa(Request $request)
    {
        try {
            $datos = $request->validate([
                'id'        => 'required|integer|exists:mesas,id',
                'numero'    => 'sometimes|required|integer|unique:mesas,numero,'.$request->id,
                'capacidad' => 'sometimes|required|integer|min:1',
            ]);

            $mesa = Mesas::find($datos['id']);
            $mesa->update($request->only(['numero','capacidad']));

            return response()->json([
                'status'  => 200,
                'message' => 'Mesa actualizada correctamente',
                'data'    => $mesa
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
                'message' => 'Error al actualizar la mesa',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Eliminar una mesa
    public function eliminarMesa(Request $request)
    {
        try {
            $datos = $request->validate([
                'id' => 'required|integer|exists:mesas,id',
            ]);

            $mesa = Mesas::find($datos['id']);
            $mesa->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Mesa eliminada correctamente',
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
                'message' => 'Error al eliminar la mesa',
                'error'   => $th->getMessage()
            ], 300);
        }
    }
}
