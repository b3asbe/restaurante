<?php
// app/Http/Controllers/CajaController.php

namespace App\Http\Controllers;

use App\Models\Caja;
use Illuminate\Http\Request;

class CajaController extends Controller
{
    /**
     * Listar todos los cierres de caja.
     */
    public function cierresCaja(Request $request)
    {
        try {
            $todos = Caja::all();

            if ($todos->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay cierres de caja registrados',
                    'data'    => null
                ], 200);
            }

            $data = $todos->map(fn($c) => [
                'id'         => $c->id,
                'fecha'      => $c->fecha,
                'total'      => $c->total,
                'usuario_id' => $c->usuario_id,
            ]);

            return response()->json([
                'status'  => 200,
                'message' => 'Cierres de caja obtenidos correctamente',
                'data'    => $data
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al listar los cierres de caja',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    /**
     * Listar los cierres de caja que coincidan con una fecha dada (YYYY-MM-DD).
     */
    public function cierresPorFecha(Request $request)
    {
        try {
            $datos = $request->validate([
                'fecha' => 'required|date_format:Y-m-d',
            ]);

            $fecha = $datos['fecha'];
            $filtros = Caja::where('fecha', $fecha)->get();

            if ($filtros->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => "No hay cierres de caja para la fecha {$fecha}",
                    'data'    => null
                ], 200);
            }

            $data = $filtros->map(fn($c) => [
                'id'         => $c->id,
                'fecha'      => $c->fecha,
                'total'      => $c->total,
                'usuario_id' => $c->usuario_id,
            ]);

            return response()->json([
                'status'  => 200,
                'message' => "Cierres de caja para la fecha {$fecha} obtenidos correctamente",
                'data'    => $data
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status'  => 422,
                'message' => 'Formato de fecha inválido. Use YYYY-MM-DD',
                'errors'  => $e->errors()
            ], 422);

        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al listar cierres de caja por fecha',
                'error'   => $th->getMessage()
            ], 300);
        }
    }
}
