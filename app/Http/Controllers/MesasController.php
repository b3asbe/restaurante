<?php

namespace App\Http\Controllers;

use App\Models\Mesas;
use Illuminate\Http\Request;

class MesasController extends Controller
{
    // Listar todas las mesas
    public function mesas()
    {
        try {
            $elementoDB = Mesas::all();

            if ($elementoDB->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay mesas registradas',
                    'data'    => null
                ], 200);
            }

            $data = [];
            foreach ($elementoDB as $item) {
                $data[] = [
                    'Id'        => $item->id,
                    'Número'    => $item->numero,
                    'Capacidad' => $item->capacidad,
                ];
            }

            return response()->json([
                'status'  => 200,
                'message' => 'Mesas obtenidas correctamente',
                'data'    => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al listar las mesas',
                'data'    => null
            ], 300);
        }
    }

    // Insertar una nueva mesa (ejemplo con valores fijos)
    public function insertarMesa($id)
    {
        try {
            $mesa = new Mesas();
            $mesa->numero    = $id;         // Ejemplo: número de mesa
            $mesa->capacidad = 4;         // Ejemplo: capacidad de la mesa
            $mesa->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Mesa creada correctamente',
                'data'    => $mesa
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al crear la mesa',
                'data'    => null
            ], 300);
        }
    }

    // Actualizar datos de una mesa existente
    public function actualizarMesa($id)
    {
        try {
            $mesa = Mesas::find($id);

            if (is_null($mesa)) {
                return response()->json([
                    'status'  => 200,
                    'message' => "No se encontró la mesa con ID {$id}",
                    'data'    => null
                ], 200);
            }

            // Ejemplo de actualización (puedes cambiar los valores según tu lógica)
            $mesa->numero    = $id;
            $mesa->capacidad = 16;
            $mesa->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Mesa actualizada correctamente',
                'data'    => $mesa
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al actualizar la mesa',
                'data'    => null
            ], 300);
        }
    }

    // Eliminar una mesa por su ID
    public function eliminarMesa($id)
    {
        try {
            $mesa = Mesas::find($id);

            if (is_null($mesa)) {
                return response()->json([
                    'status'  => 200,
                    'message' => "No se encontró la mesa con ID {$id}",
                    'data'    => null
                ], 200);
            }

            $mesa->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Mesa eliminada correctamente',
                'data'    => null
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al eliminar la mesa',
                'error'   => $th->getMessage(),
            ], 300);
        }
    }
}
