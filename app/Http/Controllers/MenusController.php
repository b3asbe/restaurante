<?php

namespace App\Http\Controllers;
use App\Models\Menus;
use Illuminate\Http\Request;

class MenusController extends Controller
{
    public function menus()
    {
        try {
            $elementoDB = Menus::all();

            if ($elementoDB->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay menús registrados',
                    'data'    => null
                ], 200);
            }

            $data = [];
            foreach ($elementoDB as $item) {
                $data[] = [
                    'Id'          => $item->id,
                    'Nombre'      => $item->nombre,
                    'Descripcion' => $item->descripcion,
                ];
            }

            return response()->json([
                'status'  => 200,
                'message' => 'Menús obtenidos correctamente',
                'data'    => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al listar los menús',
                'data'    => null
            ], 300);
        }
    }

    public function insertarMenu()
    {
        try {
            $menu = new Menus();
            $menu->nombre      = 'Menú del Día';
            $menu->descripcion = 'Plato principal + bebida + postre';
            $menu->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Menú creado correctamente',
                'data'    => $menu
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al crear el menú',
                'data'    => null
            ], 300);
        }
    }

    public function actualizarMenu($id)
    {
        try {
            $menu = Menus::find($id);

            if (is_null($menu)) {
                return response()->json([
                    'status'  => 200,
                    'message' => "No se encontró el menú con ID {$id}",
                    'data'    => null
                ], 200);
            }

            $menu->nombre      = 'Menú Vegano';
            $menu->descripcion = 'Ensalada + bebida natural';
            $menu->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Menú actualizado correctamente',
                'data'    => $menu
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al actualizar el menú',
                'data'    => null
            ], 300);
        }
    }


    public function eliminarMenu($id)
    {
        try {
            $menu = Menus::find($id);

            if (is_null($menu)) {
                return response()->json([
                    'status'  => 200,
                    'message' => "No se encontró el menú con ID {$id}",
                    'data'    => null
                ], 200);
            }

            $menu->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Menú eliminado correctamente',
                'data'    => null
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al eliminar el menú',
                'error'   => $th->getMessage(),
            ], 300);
        }
    }
}