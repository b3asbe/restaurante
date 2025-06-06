<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    /**
     * Listar todos los pedidos.
     */
    public function pedidos()
    {
        try {
            $elementoDB = Pedidos::all();

            if ($elementoDB->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay pedidos registrados',
                    'data'    => null
                ], 200);
            }

            $data = [];
            foreach ($elementoDB as $item) {
                $data[] = [
                    'Id'             => $item->id,
                    'UsuarioId'      => $item->usuario_id,
                    'MesaId'         => $item->mesa_id,
                    'EstadoId'       => $item->estado_id,
                    'FechaCreacion'  => $item->fecha_creacion,
                    'FechaEntrega'   => $item->fecha_entrega,
                ];
            }

            return response()->json([
                'status'  => 200,
                'message' => 'Pedidos obtenidos correctamente',
                'data'    => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al listar los pedidos',
                'data'    => null
            ], 300);
        }
    }

    /**
     * Insertar un nuevo pedido.
     * (Ejemplo con valores estáticos: usuario_id=1, mesa_id=1, estado_id=1)
     */
    public function insertarPedido()
    {
        try {
            $pedido = new Pedidos();
            $pedido->usuario_id     = 1;                     // Ejemplo: usuario_id
            $pedido->mesa_id        = 1;                     // Ejemplo: mesa_id
            $pedido->estado_id      = 1;                     // Ejemplo: estado_id
            // fecha_creacion se asigna automáticamente por defecto en la BD
            $pedido->fecha_entrega  = now()->addMinutes(30); // Ejemplo: 30 minutos después
            $pedido->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Pedido creado correctamente',
                'data'    => [
                    'Id'             => $pedido->id,
                    'UsuarioId'      => $pedido->usuario_id,
                    'MesaId'         => $pedido->mesa_id,
                    'EstadoId'       => $pedido->estado_id,
                    'FechaCreacion'  => $pedido->fecha_creacion,
                    'FechaEntrega'   => $pedido->fecha_entrega,
                ]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al crear el pedido',
                'data'    => null
            ], 300);
        }
    }

    /**
     * Actualizar un pedido existente.
     * Por ejemplo, cambiar estado_id a 2 y asignar nueva fecha_entrega.
     *
     * @param int $id
     */
    public function actualizarPedido($id)
    {
        try {
            $pedido = Pedidos::find($id);

            if (is_null($pedido)) {
                return response()->json([
                    'status'  => 200,
                    'message' => "No se encontró el pedido con ID {$id}",
                    'data'    => null
                ], 200);
            }

            // Ejemplo de actualización:
            $pedido->estado_id     = 2;                     // Nuevo estado_id
            $pedido->fecha_entrega = now()->addMinutes(45); // Nueva fecha de entrega
            $pedido->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Pedido actualizado correctamente',
                'data'    => [
                    'Id'             => $pedido->id,
                    'UsuarioId'      => $pedido->usuario_id,
                    'MesaId'         => $pedido->mesa_id,
                    'EstadoId'       => $pedido->estado_id,
                    'FechaCreacion'  => $pedido->fecha_creacion,
                    'FechaEntrega'   => $pedido->fecha_entrega,
                ]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al actualizar el pedido',
                'data'    => null
            ], 300);
        }
    }

    /**
     * Eliminar un pedido por su ID.
     *
     * @param int $id
     */
    public function eliminarPedido($id)
    {
        try {
            $pedido = Pedidos::find($id);

            if (is_null($pedido)) {
                return response()->json([
                    'status'  => 200,
                    'message' => "No se encontró el pedido con ID {$id}",
                    'data'    => null
                ], 200);
            }

            $pedido->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Pedido eliminado correctamente',
                'data'    => null
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al eliminar el pedido',
                'error'   => $th->getMessage(),
            ], 300);
        }
    }
}
