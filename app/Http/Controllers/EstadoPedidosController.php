<?php
// app/Http/Controllers/EstadoPedidosController.php

namespace App\Http\Controllers;

use App\Models\EstadoPedidos;
use Illuminate\Http\Request;

class EstadoPedidosController extends Controller
{
    // Listar todos los estados de pedido
    public function pedidos(Request $request)
    {
        try {
            $todos = EstadoPedidos::all();
            if ($todos->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay estados de pedido registrados',
                    'data'    => null
                ], 200);
            }

            $data = $todos->map(fn($e) => [
                'id'     => $e->id,
                'nombre' => $e->nombre,
            ]);

            return response()->json([
                'status'  => 200,
                'message' => 'Estados de pedido obtenidos correctamente',
                'data'    => $data
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Ocurrió un problema al listar los estados',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Insertar un nuevo estado de pedido
    public function insertarPedido(Request $request)
    {
        try {
            $datos = $request->validate([
                'nombre' => 'required|string|unique:estados_pedido,nombre',
            ]);

            $nuevo = EstadoPedidos::create($datos);

            return response()->json([
                'status'  => 200,
                'message' => 'Estado de pedido creado correctamente',
                'data'    => $nuevo
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
                'message' => 'Error al crear el estado de pedido',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Actualizar un estado de pedido existente
    public function actualizarPedido(Request $request)
    {
        try {
            $datos = $request->validate([
                'id'     => 'required|integer|exists:estados_pedido,id',
                'nombre' => 'required|string|unique:estados_pedido,nombre,'.$request->id,
            ]);

            $estado = EstadoPedidos::find($datos['id']);
            $estado->nombre = $datos['nombre'];
            $estado->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Estado de pedido actualizado correctamente',
                'data'    => $estado
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
                'message' => 'Error al actualizar el estado',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Eliminar un estado de pedido
    public function eliminarPedido(Request $request)
    {
        try {
            $datos = $request->validate([
                'id' => 'required|integer|exists:estados_pedido,id',
            ]);

            $estado = EstadoPedidos::find($datos['id']);
            $estado->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Estado de pedido eliminado correctamente',
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
                'message' => 'Error al eliminar el estado',
                'error'   => $th->getMessage()
            ], 300);
        }
    }
}
