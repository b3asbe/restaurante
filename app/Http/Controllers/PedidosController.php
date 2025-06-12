<?php
// app/Http/Controllers/PedidosController.php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    // Listar todos los pedidos
    public function pedidos(Request $request)
    {
        try {
            $todos = Pedidos::all();
            if ($todos->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay pedidos registrados',
                    'data'    => null
                ], 200);
            }

            $data = $todos->map(fn($p) => [
                'id'             => $p->id,
                'usuario_id'     => $p->usuario_id,
                'mesa_id'        => $p->mesa_id,
                'estado_id'      => $p->estado_id,
                'fecha_creacion' => $p->fecha_creacion,
                'fecha_entrega'  => $p->fecha_entrega,
            ]);

            return response()->json([
                'status'  => 200,
                'message' => 'Pedidos obtenidos correctamente',
                'data'    => $data
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al listar los pedidos',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Insertar un nuevo pedido
    public function insertarPedido(Request $request)
    {
        try {
            $datos = $request->validate([
                'usuario_id'    => 'required|integer|exists:usuarios,id',
                'mesa_id'       => 'required|integer|exists:mesas,id',
                'estado_id'     => 'required|integer|exists:estados,id',
                'fecha_entrega' => 'required|date_format:Y-m-d H:i:s',
            ]);

            // fecha_creacion se asigna en BD por defecto
            $pedido = Pedidos::create($datos);

            return response()->json([
                'status'  => 200,
                'message' => 'Pedido creado correctamente',
                'data'    => [
                    'id'             => $pedido->id,
                    'usuario_id'     => $pedido->usuario_id,
                    'mesa_id'        => $pedido->mesa_id,
                    'estado_id'      => $pedido->estado_id,
                    'fecha_creacion' => $pedido->fecha_creacion,
                    'fecha_entrega'  => $pedido->fecha_entrega,
                ]
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
                'message' => 'Error al crear el pedido',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Actualizar un pedido existente
    public function actualizarPedido(Request $request)
    {
        try {
            $datos = $request->validate([
                'id'             => 'required|integer|exists:pedidos,id',
                'usuario_id'     => 'sometimes|required|integer|exists:usuarios,id',
                'mesa_id'        => 'sometimes|required|integer|exists:mesas,id',
                'estado_id'      => 'sometimes|required|integer|exists:estados,id',
                'fecha_entrega'  => 'sometimes|required|date_format:Y-m-d H:i:s',
            ]);

            $pedido = Pedidos::find($datos['id']);
            $pedido->update($request->only(['usuario_id','mesa_id','estado_id','fecha_entrega']));

            return response()->json([
                'status'  => 200,
                'message' => 'Pedido actualizado correctamente',
                'data'    => [
                    'id'             => $pedido->id,
                    'usuario_id'     => $pedido->usuario_id,
                    'mesa_id'        => $pedido->mesa_id,
                    'estado_id'      => $pedido->estado_id,
                    'fecha_creacion' => $pedido->fecha_creacion,
                    'fecha_entrega'  => $pedido->fecha_entrega,
                ]
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
                'message' => 'Error al actualizar el pedido',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Eliminar un pedido
    public function eliminarPedido(Request $request)
    {
        try {
            $datos = $request->validate([
                'id' => 'required|integer|exists:pedidos,id',
            ]);

            $pedido = Pedidos::find($datos['id']);
            $pedido->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Pedido eliminado correctamente',
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
                'message' => 'Error al eliminar el pedido',
                'error'   => $th->getMessage()
            ], 300);
        }
    }
}
