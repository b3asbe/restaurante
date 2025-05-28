<?php

namespace App\Http\Controllers;
use App\Models\Insumos;
use Illuminate\Http\Request;

class InsumosController extends Controller
{
    public function insumos()
    {
        try {
            $elementoDB = Insumos::all();

            if ($elementoDB->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay insumos registrados',
                    'data'    => null
                ], 200);
            }

            $data = [];
            foreach ($elementoDB as $item) {
                $data[] = [
                    'Id'       => $item->id,
                    'Nombre'   => $item->nombre,
                    'Cantidad' => $item->cantidad,
                    'Unidad'   => $item->unidad,
                ];
            }

            return response()->json([
                'status'  => 200,
                'message' => 'Información de insumos obtenida correctamente',
                'data'    => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Ocurrió un problema al listar insumos',
                'data'    => null
            ], 300);
        }
    }


    public function insertarInsumo()
    {
        try {
            $insumo = new Insumos();
            $insumo->nombre   = 'papa';
            $insumo->cantidad = 20;
            $insumo->unidad   = 'kg';
            $insumo->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Insumo creado correctamente',
                'data'    => $insumo
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al crear el insumo',
                'data'    => null
            ], 300);
        }
    }


    public function actualizarInsumo($id)
    {
        try {
            $insumo = Insumos::find($id);

            if (is_null($insumo)) {
                return response()->json([
                    'status'  => 200,
                    'message' => "No se encontró el insumo con ID {$id}",
                    'data'    => null
                ], 200);
            }

            $insumo->nombre   = 'Papa';
            $insumo->cantidad = 50;
            $insumo->unidad   = 'kg';
            $insumo->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Insumo actualizado correctamente',
                'data'    => $insumo
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al actualizar el insumo',
                'data'    => null
            ], 300);
        }
    }

    public function eliminarInsumo($id)
    {
        try {
            $insumo = Insumos::find($id);

            if (is_null($insumo)) {
                return response()->json([
                    'status'  => 200,
                    'message' => "No se encontró el insumo con ID {$id}",
                    'data'    => null
                ], 200);
            }

            $insumo->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Insumo eliminado correctamente',
                'data'    => null
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al eliminar el insumo',
                'error'   => $th->getMessage(),
            ], 300);
        }
    }
}