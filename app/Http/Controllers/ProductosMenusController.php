<?php
// app/Http/Controllers/ProductosMenusController.php

namespace App\Http\Controllers;

use App\Models\ProductosMenus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductosMenusController extends Controller
{
    // Listar todas las relaciones menú‐producto con datos completos
    public function relaciones(Request $request)
    {
        try {
            $relaciones = ProductosMenus::with(['menu', 'producto'])->get();
            if ($relaciones->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay relaciones menú‐producto registradas',
                    'data'    => null
                ], 200);
            }

            $agrupado = $relaciones->groupBy('menu_id');

            $data = $agrupado->map(function($grupo, $menuId) {
                return [
                    'menu_id'          => (int)$menuId,
                    'menu_nombre'      => $grupo->first()->menu->nombre,
                    'menu_descripcion' => $grupo->first()->menu->descripcion,
                    'productos'        => $grupo->map(fn($item) => [
                        'producto_id'          => $item->producto_id,
                        'producto_nombre'      => $item->producto->nombre,
                        'producto_descripcion' => $item->producto->descripcion,
                        'precio'               => $item->producto->precio,
                        'stock'                => $item->producto->stock,
                    ])->values(),
                ];
            })->values();

            return response()->json([
                'status'  => 200,
                'message' => 'Relaciones menú‐producto agrupadas correctamente',
                'data'    => $data
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al listar las relaciones menú‐producto',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Insertar una nueva relación menú‐producto
    public function insertarRelacion(Request $request)
    {
        try {
            $datos = $request->validate([
                'menu_id'     => 'required|integer|exists:menus,id',
                'producto_id' => 'required|integer|exists:productos,id',
            ]);

            $rel = ProductosMenus::create($datos);

            return response()->json([
                'status'  => 200,
                'message' => 'Relación menú‐producto creada correctamente',
                'data'    => $rel
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
                'message' => 'Error al crear la relación menú‐producto',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Actualizar una relación menú‐producto existente
    public function actualizarRelacion(Request $request)
    {
        try {
            $datos = $request->validate([
                'old_menu_id'     => 'required|integer|exists:productos_menus,menu_id',
                'old_producto_id' => 'required|integer|exists:productos_menus,producto_id',
                'menu_id'         => 'sometimes|required|integer|exists:menus,id',
                'producto_id'     => 'sometimes|required|integer|exists:productos,id',
            ]);

            $query = ProductosMenus::where('menu_id', $datos['old_menu_id'])
                                    ->where('producto_id', $datos['old_producto_id']);

            $rel = $query->first();
            if (!$rel) {
                return response()->json([
                    'status'  => 404,
                    'message' => "No se encontró la relación menú {$datos['old_menu_id']} / producto {$datos['old_producto_id']}",
                    'data'    => null
                ], 404);
            }

            $update = array_filter([
                'menu_id'     => $datos['menu_id'] ?? null,
                'producto_id' => $datos['producto_id'] ?? null,
            ], fn($v) => !is_null($v));

            $query->update($update);

            $rel->refresh();

            return response()->json([
                'status'  => 200,
                'message' => 'Relación menú‐producto actualizada correctamente',
                'data'    => $rel
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
                'message' => 'Error al actualizar la relación menú‐producto',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Eliminar una relación menú‐producto
    public function eliminarRelacion(Request $request)
    {
        try {
            $datos = $request->validate([
                'menu_id'     => 'required|integer|exists:productos_menus,menu_id',
                'producto_id' => 'required|integer|exists:productos_menus,producto_id',
            ]);

            $rel = ProductosMenus::where('menu_id', $datos['menu_id'])
                                 ->where('producto_id', $datos['producto_id'])
                                 ->first();

            if (!$rel) {
                return response()->json([
                    'status'  => 404,
                    'message' => "No se encontró la relación menú {$datos['menu_id']} / producto {$datos['producto_id']}",
                    'data'    => null
                ], 404);
            }

            $rel->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Relación menú‐producto eliminada correctamente',
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
                'message' => 'Error al eliminar la relación menú‐producto',
                'error'   => $th->getMessage()
            ], 300);
        }
    }
}
