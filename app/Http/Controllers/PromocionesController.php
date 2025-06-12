<?php
// app/Http/Controllers/PromocionesController.php

namespace App\Http\Controllers;

use App\Models\Promociones;
use Illuminate\Http\Request;

class PromocionesController extends Controller
{
    // Listar todas las promociones
    public function promociones(Request $request)
    {
        try {
            $todos = Promociones::all();
            if ($todos->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay promociones registradas',
                    'data'    => null
                ], 200);
            }

            $data = $todos->map(fn($p) => [
                'id'           => $p->id,
                'nombre'       => $p->nombre,
                'descuento'    => $p->descuento,
                'fecha_inicio' => $p->fecha_inicio,
                'fecha_fin'    => $p->fecha_fin,
            ]);

            return response()->json([
                'status'  => 200,
                'message' => 'Promociones obtenidas correctamente',
                'data'    => $data
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Ocurrió un problema al listar las promociones',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Insertar una nueva promoción
    public function insertarPromocion(Request $request)
    {
        try {
            $datos = $request->validate([
                'nombre'       => 'required|string|unique:promociones,nombre',
                'descuento'    => 'required|numeric|min:0',
                'fecha_inicio' => 'required|date_format:Y-m-d',
                'fecha_fin'    => 'required|date_format:Y-m-d|after_or_equal:fecha_inicio',
            ]);

            $promo = Promociones::create($datos);

            return response()->json([
                'status'  => 200,
                'message' => 'Promoción creada correctamente',
                'data'    => $promo
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
                'message' => 'Error al crear la promoción',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Actualizar una promoción existente
    public function actualizarPromocion(Request $request)
    {
        try {
            $datos = $request->validate([
                'id'           => 'required|integer|exists:promociones,id',
                'nombre'       => 'sometimes|required|string|unique:promociones,nombre,'.$request->id,
                'descuento'    => 'sometimes|required|numeric|min:0',
                'fecha_inicio' => 'sometimes|required|date_format:Y-m-d',
                'fecha_fin'    => 'sometimes|required|date_format:Y-m-d|after_or_equal:fecha_inicio',
            ]);

            $promo = Promociones::find($datos['id']);
            $promo->update($request->only(['nombre','descuento','fecha_inicio','fecha_fin']));

            return response()->json([
                'status'  => 200,
                'message' => 'Promoción actualizada correctamente',
                'data'    => $promo
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
                'message' => 'Error al actualizar la promoción',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Eliminar una promoción
    public function eliminarPromocion(Request $request)
    {
        try {
            $datos = $request->validate([
                'id' => 'required|integer|exists:promociones,id',
            ]);

            $promo = Promociones::find($datos['id']);
            $promo->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Promoción eliminada correctamente',
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
                'message' => 'Error al eliminar la promoción',
                'error'   => $th->getMessage()
            ], 300);
        }
    }
}
