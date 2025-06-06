<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use Illuminate\Http\Request;

class CajaController extends Controller
{
    /**
     * Listar todos los cierres de caja.
     */
    public function cierresCaja()
    {
        try {
            $elementoDB = Caja::all();

            if ($elementoDB->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay cierres de caja registrados',
                    'data'    => null
                ], 200);
            }

            $data = [];
            foreach ($elementoDB as $item) {
                $data[] = [
                    'Id'         => $item->id,
                    'Fecha'      => $item->fecha,
                    'Total'      => $item->total,
                    'UsuarioId'  => $item->usuario_id,
                ];
            }

            return response()->json([
                'status'  => 200,
                'message' => 'Cierres de caja obtenidos correctamente',
                'data'    => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al listar los cierres de caja',
                'data'    => null
            ], 300);
        }
    }

    /**
     * Listar los cierres de caja que coincidan con una fecha dada (YYYY-MM-DD).
     */
    public function cierresPorFecha($fecha)
    {
        try {
            // Validar formato de fecha simples
            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
                return response()->json([
                    'status'  => 422,
                    'message' => 'Formato de fecha inválido. Use YYYY-MM-DD',
                    'data'    => null
                ], 422);
            }

            $elementoDB = Caja::where('fecha', $fecha)->get();

            if ($elementoDB->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => "No hay cierres de caja para la fecha {$fecha}",
                    'data'    => null
                ], 200);
            }

            $data = [];
            foreach ($elementoDB as $item) {
                $data[] = [
                    'Id'         => $item->id,
                    'Fecha'      => $item->fecha,
                    'Total'      => $item->total,
                    'UsuarioId'  => $item->usuario_id,
                ];
            }

            return response()->json([
                'status'  => 200,
                'message' => "Cierres de caja para la fecha {$fecha} obtenidos correctamente",
                'data'    => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al listar cierres de caja por fecha',
                'data'    => null
            ], 300);
        }
    }
}
