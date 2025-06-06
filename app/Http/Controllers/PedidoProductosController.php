<?php

namespace App\Http\Controllers;

use App\Models\PedidoProductos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoProductosController extends Controller
{
    /**
     * Listar todos los productos en cada pedido.
     */
    public function relaciones()
    {
        try {
            $relaciones = PedidoProductos::all();

            if ($relaciones->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay registros de pedido‐productos',
                    'data'    => null
                ], 200);
            }

            $data = [];
            foreach ($relaciones as $item) {
                $data[] = [
                    'PedidoId'      => $item->pedido_id,
                    'ProductoId'    => $item->producto_id,
                    'Cantidad'      => $item->cantidad,
                    'PrecioUnitario'=> $item->precio_unitario,
                ];
            }

            return response()->json([
                'status'  => 200,
                'message' => 'Relaciones pedido‐productos obtenidas correctamente',
                'data'    => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al listar pedido‐productos',
                'data'    => null
            ], 300);
        }
    }

    /**
     * Insertar una nueva relación pedido‐producto.
     * (Ejemplo con valores estáticos: pedido_id=11, producto_id=11, cantidad=1, precio_unitario=100.00)
     */
    public function insertarRelacion()
    {
        try {
            $relacion = new PedidoProductos();
            $relacion->pedido_id       = 10;    // Ejemplo: ID de pedido
            $relacion->producto_id     = 4;    // Ejemplo: ID de producto
            $relacion->cantidad        = 1;     // Ejemplo: cantidad
            $relacion->precio_unitario = 100.00; // Ejemplo: precio unitario
            $relacion->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Relación pedido‐producto creada correctamente',
                'data'    => [
                    'PedidoId'      => $relacion->pedido_id,
                    'ProductoId'    => $relacion->producto_id,
                    'Cantidad'      => $relacion->cantidad,
                    'PrecioUnitario'=> $relacion->precio_unitario,
                ]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al crear la relación pedido‐producto',
                'data'    => null
            ], 300);
        }
    }

    /**
     * Actualizar una relación pedido‐producto existente.
     * Por ejemplo, cambiar cantidad y precio_unitario para el par dado.
     *
     * @param int $pedidoId
     * @param int $productoId
     */
    public function actualizarRelacion($pedidoId, $productoId)
    {
        try {
            $existe = PedidoProductos::where('pedido_id', $pedidoId)
                                     ->where('producto_id', $productoId)
                                     ->first();

            if (is_null($existe)) {
                return response()->json([
                    'status'  => 200,
                    'message' => "No se encontró relación para pedido {$pedidoId} / producto {$productoId}",
                    'data'    => null
                ], 200);
            }

            // Ejemplo de nuevos valores: cantidad=5, precio_unitario=50.00
            $nuevaCantidad        = 5;
            $nuevoPrecioUnitario  = 50.00;

            DB::table('pedido_productos')
                ->where('pedido_id', $pedidoId)
                ->where('producto_id', $productoId)
                ->update([
                    'cantidad'        => $nuevaCantidad,
                    'precio_unitario' => $nuevoPrecioUnitario,
                ]);

            return response()->json([
                'status'  => 200,
                'message' => 'Relación pedido‐producto actualizada correctamente',
                'data'    => [
                    'PedidoIdOriginal'       => $pedidoId,
                    'ProductoIdOriginal'     => $productoId,
                    'CantidadNuevo'          => $nuevaCantidad,
                    'PrecioUnitarioNuevo'    => $nuevoPrecioUnitario,
                ]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al actualizar la relación pedido‐producto',
                'data'    => null
            ], 300);
        }
    }

    /**
     * Eliminar una relación pedido‐producto por su par de claves.
     *
     * @param int $pedidoId
     * @param int $productoId
     */
    public function eliminarRelacion($pedidoId, $productoId)
    {
        try {
            $relacion = PedidoProductos::where('pedido_id', $pedidoId)
                                       ->where('producto_id', $productoId)
                                       ->first();

            if (is_null($relacion)) {
                return response()->json([
                    'status'  => 200,
                    'message' => "No se encontró relación para pedido {$pedidoId} / producto {$productoId}",
                    'data'    => null
                ], 200);
            }

            DB::table('pedido_productos')
                ->where('pedido_id', $pedidoId)
                ->where('producto_id', $productoId)
                ->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Relación pedido‐producto eliminada correctamente',
                'data'    => null
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al eliminar la relación pedido‐producto',
                'error'   => $th->getMessage(),
            ], 300);
        }
    }
}
