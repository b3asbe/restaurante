<?php
// app/Http/Controllers/RolesController.php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    // Listar todos los roles
    public function roles(Request $request)
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

            $data = $rolesDB->map(fn($item) => [
                'id'     => $item->id,
                'nombre' => $item->nombre,
            ]);

            return response()->json([
                'status'  => 200,
                'message' => 'Roles obtenidos correctamente',
                'data'    => $data
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al listar los roles',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Insertar un nuevo rol
    public function insertarRole(Request $request)
    {
        try {
            $datos = $request->validate([
                'nombre' => 'required|string|unique:roles,nombre',
            ]);

            $role = Roles::create($datos);

            return response()->json([
                'status'  => 200,
                'message' => 'Rol creado correctamente',
                'data'    => $role
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
                'message' => 'Error al crear el rol',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Actualizar un rol existente
    public function actualizarRole(Request $request)
    {
        try {
            $datos = $request->validate([
                'id'     => 'required|integer|exists:roles,id',
                'nombre' => 'required|string|unique:roles,nombre,'.$request->id,
            ]);

            $role = Roles::find($datos['id']);
            $role->nombre = $datos['nombre'];
            $role->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Rol actualizado correctamente',
                'data'    => $role
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
                'message' => 'Error al actualizar el rol',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Eliminar un rol
    public function eliminarRole(Request $request)
    {
        try {
            $datos = $request->validate([
                'id' => 'required|integer|exists:roles,id',
            ]);

            $role = Roles::find($datos['id']);
            $role->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Rol eliminado correctamente',
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
                'message' => 'Error al eliminar el rol',
                'error'   => $th->getMessage()
            ], 300);
        }
    }
}
