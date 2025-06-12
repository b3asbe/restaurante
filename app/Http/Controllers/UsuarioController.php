<?php
// app/Http/Controllers/UsuarioController.php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // Listar usuarios
    public function usuarios(Request $request)
    {
        try {
            $todos = Usuario::all();
            if ($todos->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay usuarios registrados',
                    'data'    => null
                ], 200);
            }

            $data = $todos->map(fn($u) => [
                'id'      => $u->id,
                'nombre'  => $u->nombre,
                'correo'  => $u->correo,
                'rol_id'  => $u->rol_id,
            ]);

            return response()->json([
                'status'  => 200,
                'message' => 'Información obtenida correctamente',
                'data'    => $data
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Ocurrió un problema al listar usuarios',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Insertar un usuario
    public function insertarUsuario(Request $request)
    {
        try {
            $datos = $request->validate([
                'nombre'       => 'required|string',
                'correo'       => 'required|email|unique:usuarios,correo',
                'contraseña'   => 'required|string|min:6',
                'rol_id'       => 'required|integer|exists:roles,id',
            ]);

            // Encriptar contraseña
            $datos['contraseña'] = Hash::make($datos['contraseña']);

            $usuario = Usuario::create($datos);

            return response()->json([
                'status'  => 200,
                'message' => 'Usuario creado correctamente',
                'data'    => $usuario
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
                'message' => 'Error al crear el usuario',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Actualizar un usuario
    public function actualizarUsuario(Request $request)
    {
        try {
            $datos = $request->validate([
                'id'           => 'required|integer|exists:usuarios,id',
                'nombre'       => 'sometimes|required|string',
                'correo'       => 'sometimes|required|email|unique:usuarios,correo',
                'contraseña'   => 'sometimes|required|string|min:6',
                'rol_id'       => 'sometimes|required|integer|exists:roles,id',
            ]);

            $usuario = Usuario::find($datos['id']);

            if (isset($datos['contraseña'])) {
                $datos['contraseña'] = Hash::make($datos['contraseña']);
            }

            $usuario->update($datos);

            return response()->json([
                'status'  => 200,
                'message' => 'Usuario actualizado correctamente',
                'data'    => $usuario
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
                'message' => 'Error al actualizar el usuario',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Eliminar un usuario
    public function eliminarUsuario(Request $request)
    {
        try {
            $datos = $request->validate([
                'id' => 'required|integer|exists:usuarios,id',
            ]);

            $usuario = Usuario::find($datos['id']);
            $usuario->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Usuario eliminado correctamente',
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
                'message' => 'Error al eliminar el usuario',
                'error'   => $th->getMessage()
            ], 300);
        }
    }
}
