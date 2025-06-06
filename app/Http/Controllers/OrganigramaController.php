<?php

namespace App\Http\Controllers;

use App\Models\Organigrama;
use Illuminate\Http\Request;

class OrganigramaController extends Controller
{
    /**
     * Listar todos los puestos en el organigrama.
     */
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

    /**
     * Insertar un nuevo puesto en el organigrama.
     * (Ejemplo con valores estáticos: nombre="Nuevo Puesto", parent_id=null)
     */
    public function insertarOrganigrama()
    {
        try {
            $puesto = new Organigrama();
            $puesto->nombre    = 'Nuevo Puesto';   // Ejemplo de nombre
            $puesto->parent_id = 20;             // Ejemplo: sin padre (nivel raíz)
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

    /**
     * Actualizar un puesto existente en el organigrama.
     * Por ejemplo, cambiar nombre y/o parent_id.
     *
     * @param int $id
     */
    public function actualizarOrganigrama($id)
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

            // Ejemplo de nuevos valores:
            $puesto->nombre    = 'Nuevo Puesto';
            $puesto->parent_id = 2; // Ejemplo: asignar al padre con ID 1
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

    /**
     * Eliminar un puesto del organigrama por su ID.
     *
     * @param int $id
     */
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
