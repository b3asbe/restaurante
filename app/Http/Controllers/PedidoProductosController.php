<?php
// app/Http/Controllers/PedidoProductosController.php

namespace App\Http\Controllers;

use App\Models\PedidoProductos;
use Illuminate\Http\Request;

class PedidoProductosController extends Controller
{
    // Listar todos los registros pedido‐producto
    public function relaciones(Request $request)
    {
        try {
            $todos = PedidoProductos::all();
            if ($todos->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay registros de pedido‐productos',
                    'data'    => null
                ], 200);
            }

            $data = $todos->map(fn($r) => [
                'pedido_id'       => $r->pedido_id,
                'producto_id'     => $r->producto_id,
                'cantidad'        => $r->cantidad,
                'precio_unitario' => $r->precio_unitario,
            ]);

            return response()->json([
                'status'  => 200,
                'message' => 'Relaciones pedido‐productos obtenidas correctamente',
                'data'    => $data
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al listar pedido‐productos',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Insertar una nueva relación pedido‐producto
    public function insertarRelacion(Request $request)
    {
        try {
            $datos = $request->validate([
                'pedido_id'       => 'required|integer|exists:pedidos,id',
                'producto_id'     => 'required|integer|exists:productos,id',
                'cantidad'        => 'required|integer|min:1',
                'precio_unitario' => 'required|numeric|min:0',
            ]);

            $rel = PedidoProductos::create($datos);

            return response()->json([
                'status'  => 200,
                'message' => 'Relación pedido‐producto creada correctamente',
                'data'    => [
                    'pedido_id'       => $rel->pedido_id,
                    'producto_id'     => $rel->producto_id,
                    'cantidad'        => $rel->cantidad,
                    'precio_unitario' => $rel->precio_unitario,
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
                'message' => 'Error al crear la relación pedido‐producto',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Actualizar una relación pedido‐producto existente
    public function actualizarRelacion(Request $request)
    {
        try {
            $datos = $request->validate([
                'pedido_id'       => 'required|integer|exists:pedidos,id',
                'producto_id'     => 'required|integer|exists:productos,id',
                'cantidad'        => 'sometimes|required|integer|min:1',
                'precio_unitario' => 'sometimes|required|numeric|min:0',
            ]);

            $rel = PedidoProductos::where('pedido_id', $datos['pedido_id'])
                                  ->where('producto_id', $datos['producto_id'])
                                  ->first();

            if (!$rel) {
                return response()->json([
                    'status'  => 404,
                    'message' => "No se encontró relación para pedido {$datos['pedido_id']} / producto {$datos['producto_id']}",
                    'data'    => null
                ], 404);
            }

            $rel->update($request->only(['cantidad','precio_unitario']));

            return response()->json([
                'status'  => 200,
                'message' => 'Relación pedido‐producto actualizada correctamente',
                'data'    => [
                    'pedido_id'       => $rel->pedido_id,
                    'producto_id'     => $rel->producto_id,
                    'cantidad'        => $rel->cantidad,
                    'precio_unitario' => $rel->precio_unitario,
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
                'message' => 'Error al actualizar la relación pedido‐producto',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Eliminar una relación pedido‐producto
    public function eliminarRelacion(Request $request)
    {
        try {
            $datos = $request->validate([
                'pedido_id'   => 'required|integer|exists:pedidos,id',
                'producto_id' => 'required|integer|exists:productos,id',
            ]);

            $rel = PedidoProductos::where('pedido_id', $datos['pedido_id'])
                                  ->where('producto_id', $datos['producto_id'])
                                  ->first();

            if (!$rel) {
                return response()->json([
                    'status'  => 404,
                    'message' => "No se encontró relación para pedido {$datos['pedido_id']} / producto {$datos['producto_id']}",
                    'data'    => null
                ], 404);
            }

            $rel->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Relación pedido‐producto eliminada correctamente',
                'data'    => null
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
                'message' => 'Error al eliminar la relación pedido‐producto',
                'error'   => $th->getMessage()
            ], 300);
        }
    }
}
