<?php

namespace App\Http\Controllers;

use App\Models\ProductosMenus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductosMenusController extends Controller
{
    /**
     * Listar todas las relaciones menú‐producto.
     */
    public function relaciones()
    {
        try {
            $relaciones = ProductosMenus::all();

            if ($relaciones->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay relaciones menú‐producto registradas',
                    'data'    => null
                ], 200);
            }

            $data = [];
            foreach ($relaciones as $item) {
                $data[] = [
                    'MenuId'     => $item->menu_id,
                    'ProductoId' => $item->producto_id,
                ];
            }

            return response()->json([
                'status'  => 200,
                'message' => 'Relaciones menú‐producto obtenidas correctamente',
                'data'    => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al listar las relaciones menú‐producto',
                'data'    => null
            ], 300);
        }
    }

    /**
     * Insertar una nueva relación menú‐producto.
     * (Ejemplo con valores estáticos: menu_id = 11, producto_id = 11)
     */
    public function insertarRelacion()
    {
        try {
            $relacion = new ProductosMenus();
            $relacion->menu_id     = 2; // Ejemplo: nuevo menú_id
            $relacion->producto_id = 6; // Ejemplo: nuevo producto_id
            $relacion->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Relación menú‐producto creada correctamente',
                'data'    => [
                    'MenuId'     => $relacion->menu_id,
                    'ProductoId' => $relacion->producto_id,
                ]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al crear la relación menú‐producto',
                'data'    => null
            ], 300);
        }
    }

    /**
     * Actualizar una relación menú‐producto existente.
     * Por ejemplo, cambiar producto_id a 99 para el par dado.
     *
     * @param int $menuId
     * @param int $productoId
     */
    public function actualizarRelacion($menuId, $productoId)
    {
        try {
            $existe = ProductosMenus::where('menu_id', $menuId)
                                     ->where('producto_id', $productoId)
                                     ->first();

            if (is_null($existe)) {
                return response()->json([
                    'status'  => 200,
                    'message' => "No se encontró la relación menú {$menuId} / producto {$productoId}",
                    'data'    => null
                ], 200);
            }

            // Ejemplo de actualización: asignar nuevos IDs (plan: menu_id = 1, producto_id = 50)
            $nuevoMenuId     = 2;
            $nuevoProductoId = 5;

            DB::table('productos_menus')
                ->where('menu_id', $menuId)
                ->where('producto_id', $productoId)
                ->update([
                    'menu_id'     => $nuevoMenuId,
                    'producto_id' => $nuevoProductoId
                ]);

            return response()->json([
                'status'  => 200,
                'message' => 'Relación menú‐producto actualizada correctamente',
                'data'    => [
                    'MenuId'     => $menuId,
                    'ProductoIdOriginal' => $productoId,
                    'MenuIdNuevo'        => $nuevoMenuId,
                    'ProductoIdNuevo'    => $nuevoProductoId,
                ]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al actualizar la relación menú‐producto',
                'data'    => null
            ], 300);
        }
    }

    /**
     * Eliminar una relación menú‐producto por su par de claves.
     *
     * @param int $menuId
     * @param int $productoId
     */
    public function eliminarRelacion($menuId, $productoId)
    {
        try {
            $relacion = ProductosMenus::where('menu_id', $menuId)
                                      ->where('producto_id', $productoId)
                                      ->first();

            if (is_null($relacion)) {
                return response()->json([
                    'status'  => 200,
                    'message' => "No se encontró la relación menú {$menuId} / producto {$productoId}",
                    'data'    => null
                ], 200);
            }

            DB::table('productos_menus')
                ->where('menu_id', $menuId)
                ->where('producto_id', $productoId)
                ->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Relación menú‐producto eliminada correctamente',
                'data'    => null
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al eliminar la relación menú‐producto',
                'error'   => $th->getMessage(),
            ], 300);
        }
    }
}
