<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{

    public function usuarios()
    {
        try {
            $elementoDB = Usuario::all();

            if ($elementoDB->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay usuarios registrados',
                    'data'    => null
                ], 200);
            }

            $dataUsuarios = [];
            foreach ($elementoDB as $usuario) {
                $dataUsuarios[] = [
                    'Nombre'  => $usuario->nombre,
                    'Correo'  => $usuario->correo,
                    'RolId'   => $usuario->rol_id,
                ];
            }

            return response()->json([
                'status'  => 200,
                'message' => 'Información obtenida correctamente',
                'data'    => $dataUsuarios
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Ocurrió un problema',
                'data'    => null
            ], 300);
        }
    }

    //Insertar un Usuario
    public function insertarUsuario()
    {
        try {
            $usuario = new Usuario();
            $usuario->nombre      = 'Andre Santos';
            $usuario->correo      = 'andrez@gmail.com';
            $usuario->contraseña  = bcrypt('123456');
            $usuario->rol_id      = 1;
            $usuario->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Usuario creado correctamente',
                'data'    => $usuario
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al crear el usuario',
                'data'    => null
            ], 300);
        }
    }

    //Actualizar Usuario
    public function actualizarUsuario($id)
    {
        try {
            $usuario = Usuario::find($id);

            if (is_null($usuario)) {
                return response()->json([
                    'status'  => 200,
                    'message' => "No se encontró el usuario con ID {$id}",
                    'data'    => null
                ], 200);
            }

            $usuario->nombre      = 'Mariela Gómez';
            $usuario->correo      = 'mariela@gmail.com';
            $usuario->contraseña  = bcrypt('zzzzzzz');
            $usuario->rol_id      = 2;
            $usuario->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Usuario actualizado correctamente',
                'data'    => $usuario
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al actualizar el usuario',
                'data'    => null
            ], 300);
        }
    }

    //Eliminar Usuario
    public function eliminarUsuario($id)
    {
        try {
            $usuario = Usuario::find($id);

            if (is_null($usuario)) {
                return response()->json([
                    'status'  => 200,
                    'message' => "No se encontró el usuario con ID {$id}",
                    'data'    => null
                ], 200);
            }

            $usuario->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Usuario eliminado correctamente',
                'data'    => null
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al eliminar el usuario',
                'error'   => $th->getMessage(),
            ], 300);
        }
    }
}
