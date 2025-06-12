<?php

namespace App\Http\Controllers;

use App\Models\ProductosMenus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductosMenusController extends Controller
{
    /**
     * Listar todas las relaciones menú‐producto con datos completos.
     */
    public function relaciones()
{
    try {
        // Trae todas las relaciones con menú y producto
        $relaciones = ProductosMenus::with(['menu', 'producto'])->get();

        if ($relaciones->isEmpty()) {
            return response()->json([
                'status'  => 200,
                'message' => 'No hay relaciones menú‐producto registradas',
                'data'    => null
            ], 200);
        }

        // Agrupamos por menú
        $agrupado = $relaciones->groupBy('menu_id');

        // Formateamos la respuesta
        $data = $agrupado->map(function($grupo, $menuId) {
            return [
                'MenuId'          => (int) $menuId,
                'MenuNombre'      => $grupo->first()->menu->nombre,
                'MenuDescripcion' => $grupo->first()->menu->descripcion,
                'Productos'       => $grupo->map(function($item) {
                    return [
                        'ProductoId'          => $item->producto_id,
                        'ProductoNombre'      => $item->producto->nombre,
                        'ProductoDescripcion' => $item->producto->descripcion,
                        'Precio'              => $item->producto->precio,
                        'Stock'               => $item->producto->stock,
                    ];
                })->values(), // reindexa el array interno
            ];
        })->values(); // reindexa el array externo

        return response()->json([
            'status'  => 200,
            'message' => 'Relaciones menú‐producto agrupadas correctamente',
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


    public function insertarRelacion()
    {
        try {
            $relacion = new ProductosMenus();
            $relacion->menu_id     = 1; 
            $relacion->producto_id = 6; 
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

            // Ejemplo: aquí podrías cambiar menu_id/producto_id
            DB::table('productos_menus')
                ->where('menu_id', $menuId)
                ->where('producto_id', $productoId)
                ->update([
                    'menu_id'     => $menuId,
                    'producto_id' => $productoId
                ]);

            return response()->json([
                'status'  => 200,
                'message' => 'Relación menú‐producto actualizada correctamente',
                'data'    => [
                    'MenuIdOriginal'     => $menuId,
                    'ProductoIdOriginal' => $productoId,
                    'MenuIdNuevo'        => $menuId,
                    'ProductoIdNuevo'    => $productoId,
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

}
