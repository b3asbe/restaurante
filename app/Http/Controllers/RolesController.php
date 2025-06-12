<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    // Listar todos los roles
    public function roles()
    {
        try {
            $rolesDB = Roles::all();

            if ($rolesDB->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay roles registrados',
                    'data'    => null
                ], 200);
            }

            $data = [];
            foreach ($rolesDB as $item) {
                $data[] = [
                    'Id'     => $item->id,
                    'Nombre' => $item->nombre,
                ];
            }

            return response()->json([
                'status'  => 200,
                'message' => 'Roles obtenidos correctamente',
                'data'    => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al listar los roles',
                'data'    => null
            ], 300);
        }
    }

    // Insertar un nuevo rol
    public function insertarRole()
    {
        try {
            $role = new Roles();
            $role->nombre = 'Administrador 2';
            $role->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Rol creado correctamente',
                'data'    => $role
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al crear el rol',
                'data'    => null
            ], 300);
        }
    }

    // Actualizar un rol existente
    public function actualizarRole($id)
    {
        try {
            $role = Roles::find($id);

            if (is_null($role)) {
                return response()->json([
                    'status'  => 200,
                    'message' => "No se encontró el rol con ID {$id}",
                    'data'    => null
                ], 200);
            }

            $role->nombre = 'Supervisor 2';
            $role->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Rol actualizado correctamente',
                'data'    => $role
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al actualizar el rol',
                'data'    => null
            ], 300);
        }
    }

    // Eliminar un rol
    public function eliminarRole($id)
    {
        try {
            $role = Roles::find($id);

            if (is_null($role)) {
                return response()->json([
                    'status'  => 200,
                    'message' => "No se encontró el rol con ID {$id}",
                    'data'    => null
                ], 200);
            }

            $role->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Rol eliminado correctamente',
                'data'    => null
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al eliminar el rol',
                'error'   => $th->getMessage(),
            ], 300);
        }
    }
}
