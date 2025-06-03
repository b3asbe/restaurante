<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovimientosInsumo;

class MovimientosInsumoController extends Controller
{
    /**
     * Listar todos los movimientos de insumo
     */
    public function movimientos()
    {
        try {
            $elementoDB = MovimientosInsumo::all();

            if ($elementoDB->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay movimientos de insumo registrados',
                    'data'    => null
                ], 200);
            }

            // Preparar salida
            $dataMovimientos = [];
            foreach ($elementoDB as $mov) {
                $dataMovimientos[] = [
                    'ID'        => $mov->id,
                    'InsumoID'  => $mov->insumo_id,
                    'Cantidad'  => $mov->cantidad,
                    'Tipo'      => $mov->tipo,
                    'Fecha'     => $mov->fecha,
                ];
            }

            return response()->json([
                'status'  => 200,
                'message' => 'Movimientos obtenidos correctamente',
                'data'    => $dataMovimientos
            ], 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Ocurrió un problema al listar los movimientos',
                'data'    => null,
            ], 300);
        }
    }

    /**
     * Insertar un nuevo movimiento de insumo (ejemplo hardcodeado)
     */
    public function insertarMovimiento()
    {
        try {
            $nuevo = new MovimientosInsumo();
            $nuevo->insumo_id = 1;                          // Ejemplo: insumo con ID 1
            $nuevo->cantidad  = 100;                        // Ejemplo de cantidad
            $nuevo->tipo      = 'ENTRADA';                   // Puede ser 'ENTRADA' o 'SALIDA'
            $nuevo->fecha     = '2025-05-20 09:30:00';       // Ejemplo de fecha/hora
            $nuevo->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Movimiento de insumo creado correctamente',
                'data'    => $nuevo
            ], 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al crear el movimiento de insumo',
                'data'    => null,
            ], 300);
        }
    }

    /**
     * Actualizar un movimiento de insumo por su ID
     */
    public function actualizarMovimiento($id)
    {
        try {
            $mov = MovimientosInsumo::find($id);

            if (is_null($mov)) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No se encontró el movimiento con ID ' . $id,
                    'data'    => null
                ], 200);
            }

            // Ejemplo de nuevos valores (puedes reemplazar por $request->input('campo'))
            $mov->insumo_id = 2;                          // Cambiamos a insumo con ID 2
            $mov->cantidad  = 50;                         // Nueva cantidad
            $mov->tipo      = 'SALIDA';                   // Ejemplo cambio a SALIDA
            $mov->fecha     = '2025-05-21 14:45:00';       // Nueva fecha/hora
            $mov->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Movimiento de insumo actualizado correctamente',
                'data'    => $mov
            ], 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al actualizar el movimiento',
                'data'    => null,
            ], 300);
        }
    }

    /**
     * Eliminar un movimiento de insumo por su ID
     */
    public function eliminarMovimiento($id)
    {
        try {
            $mov = MovimientosInsumo::find($id);

            if (is_null($mov)) {
                return response()->json([
                    'status'  => 200,
                    'message' => "No se encontró el movimiento con ID $id",
                    'data'    => null
                ], 200);
            }

            $mov->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Movimiento de insumo eliminado correctamente',
                'data'    => null
            ], 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al eliminar el movimiento',
                'error'   => $th->getMessage(),
            ], 300);
        }
    }
}
