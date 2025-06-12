<?php

namespace App\Http\Controllers;

use App\Models\Organigrama;
use Illuminate\Http\Request;

class OrganigramaController extends Controller
{

    public function organigramas()
    {
        try {
            $elementoDB = Organigrama::all();

            if ($elementoDB->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay puestos registrados en el organigrama',
                    'data'    => null
                ], 200);
            }

            $data = [];
            foreach ($elementoDB as $item) {
                $data[] = [
                    'Id'       => $item->id,
                    'Nombre'   => $item->nombre,
                    'ParentId' => $item->parent_id,
                ];
            }

            return response()->json([
                'status'  => 200,
                'message' => 'Organigrama obtenido correctamente',
                'data'    => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al listar el organigrama',
                'data'    => null
            ], 300);
        }
    }
public function insertarOrganigrama($id, $nombre)
{
   
    $nombre = trim($nombre);
    if (strlen($nombre) < 4) {
        return response()->json([
            'status'  => 422,
            'message' => 'El nombre debe tener al menos 4 caracteres (sin contar espacios en los extremos).',
            'data'    => null
        ], 422);
    }

    try {
        $puesto = new Organigrama();
        $puesto->nombre    = $nombre;
        $puesto->parent_id = $id;
        $puesto->save();

        return response()->json([
            'status'  => 200,
            'message' => 'Puesto agregado al organigrama correctamente',
            'data'    => [
                'Id'       => $puesto->id,
                'Nombre'   => $puesto->nombre,
                'ParentId' => $puesto->parent_id,
            ]
        ], 200);
    } catch (\Throwable $th) {
        return response()->json([
            'status'  => 300,
            'message' => 'Error al crear el puesto en el organigrama',
            'data'    => null
        ], 300);
    }
}

public function actualizarOrganigrama($id, $padre, $nombre)
{
    // 1) Evitar sólo espacios y forzar mínimo 4 caracteres
    $nombre = trim($nombre);
    if (strlen($nombre) < 4) {
        return response()->json([
            'status'  => 422,
            'message' => 'El nombre debe tener al menos 4 caracteres (sin contar espacios en los extremos).',
            'data'    => null
        ], 422);
    }

    try {
        $puesto = Organigrama::find($id);
        if (!$puesto) {
            return response()->json([
                'status'  => 404,
                'message' => "No se encontró el puesto con ID {$id}",
                'data'    => null
            ], 404);
        }

        $puesto->nombre    = $nombre;
        $puesto->parent_id = $padre;
        $puesto->save();

        return response()->json([
            'status'  => 200,
            'message' => 'Puesto actualizado correctamente',
            'data'    => [
                'Id'       => $puesto->id,
                'Nombre'   => $puesto->nombre,
                'ParentId' => $puesto->parent_id,
            ]
        ], 200);
    } catch (\Throwable $th) {
        return response()->json([
            'status'  => 300,
            'message' => 'Error al actualizar el puesto en el organigrama',
            'data'    => null
        ], 300);
    }
}



    public function eliminarOrganigrama($id)
    {
        try {
            $puesto = Organigrama::find($id);

            if (is_null($puesto)) {
                return response()->json([
                    'status'  => 200,
                    'message' => "No se encontró el puesto con ID {$id}",
                    'data'    => null
                ], 200);
            }

            $puesto->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Puesto eliminado correctamente del organigrama',
                'data'    => null
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al eliminar el puesto del organigrama',
                'error'   => $th->getMessage(),
            ], 300);
        }
    }

        public function verOrganigrama()
    {
        // Obtiene todos los puestos
        $puestos = Organigrama::all(['id', 'nombre', 'parent_id']);
        return view('organigrama.ver', compact('puestos'));
    }

}
