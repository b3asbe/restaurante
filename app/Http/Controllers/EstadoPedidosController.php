<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstadoPedidos;

class EstadoPedidosController extends Controller
{
    /**
     * Listar todos los estados de pedido
     */
    public function pedidos()
    {
        try {
            // Aquí referenciamos al modelo correcto: EstadoPedidos, no Pedidos
            $elementoDB = EstadoPedidos::all();

            if ($elementoDB->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay estados de pedido registrados',
                    'data'    => null
                ], 200);
            }

            // Preparar salida
            $dataEstados = [];
            foreach ($elementoDB as $estado) {
                $dataEstados[] = [
                    'ID'     => $estado->id,
                    'Nombre' => $estado->nombre,
                ];
            }

            return response()->json([
                'status'  => 200,
                'message' => 'Estados de pedido obtenidos correctamente',
                'data'    => $dataEstados
            ], 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Ocurrió un problema al listar los estados',
                'data'    => null,
            ], 300);
        }
    }

    /**
     * Insertar un nuevo estado de pedido (ejemplo hardcodeado)
     */
    public function insertarPedido()
    {
        try {
            // Usamos EstadoPedidos en lugar de Pedidos
            $nuevo = new EstadoPedidos();
            $nuevo->nombre = 'En proceso';  // Ejemplo de nombre
            $nuevo->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Estado de pedido creado correctamente',
                'data'    => $nuevo
            ], 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al crear el estado de pedido',
                'data'    => null,
            ], 300);
        }
    }

    /**
     * Actualizar un estado de pedido por su ID
     */
    public function actualizarPedido($id)
    {
        try {
            // Buscamos con el modelo correcto
            $estado = EstadoPedidos::find($id);

            if (is_null($estado)) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No se encontró el estado con ID ' . $id,
                    'data'    => null
                ], 200);
            }

            // Ejemplo de nuevo nombre (puedes reemplazarlo por $request->input('nombre'))
            $estado->nombre = 'Completado';
            $estado->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Estado de pedido actualizado correctamente',
                'data'    => $estado
            ], 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al actualizar el estado',
                'data'    => null,
            ], 300);
        }
    }

    /**
     * Eliminar un estado de pedido por su ID
     */
    public function eliminarPedido($id)
    {
        try {
            $estado = EstadoPedidos::find($id);

            if (is_null($estado)) {
                return response()->json([
                    'status'  => 200,
                    'message' => "No se encontró el estado con ID $id",
                    'data'    => null
                ], 200);
            }

            $estado->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Estado de pedido eliminado correctamente',
                'data'    => null
            ], 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al eliminar el estado',
                'error'   => $th->getMessage(),
            ], 300);
        }
    }
}
