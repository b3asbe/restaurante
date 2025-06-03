<?php

namespace App\Http\Controllers;

use App\Models\Promociones;
use Illuminate\Http\Request;

class PromocionesController extends Controller
{
    /**
     * Listar todas las promociones
     */
    public function promociones()
    {
        try {
            $elementoDB = Promociones::all();

            if ($elementoDB->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay promociones registradas',
                    'data'    => null
                ], 200);
            }

            // Preparar los datos para la respuesta
            $dataPromociones = [];
            foreach ($elementoDB as $promocion) {
                $dataPromociones[] = [
                    'Nombre'       => $promocion->nombre,
                    'Descuento'    => $promocion->descuento,
                    'FechaInicio'  => $promocion->fecha_inicio,
                    'FechaFin'     => $promocion->fecha_fin,
                ];
            }

            return response()->json([
                'status'  => 200,
                'message' => 'Promociones obtenidas correctamente',
                'data'    => $dataPromociones
            ], 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Ocurrió un problema al listar las promociones',
                'data'    => null,
            ], 300);
        }
    }

    /**
     * Insertar una nueva promoción
     */
    public function insertarPromocion()
    {
        try {
            $promo = new Promociones();
            $promo->nombre       = 'Rebaja de verano';
            $promo->descuento    = 20.00;
            $promo->fecha_inicio = '2025-06-15';
            $promo->fecha_fin    = '2025-07-15';
            $promo->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Promoción creada correctamente',
                'data'    => $promo
            ], 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al crear la promoción',
                'data'    => null,
            ], 300);
        }
    }

    /**
     * Actualizar una promoción existente por su ID
     */
    public function actualizarPromocion($id)
    {
        try {
            $promo = Promociones::find($id);

            if (is_null($promo)) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No se encontró la promoción con ID ' . $id,
                    'data'    => null
                ], 200);
            }

            // Asignar nuevos valores (ejemplo hardcodeado)
            $promo->nombre       = 'Descuento especial julio';
            $promo->descuento    = 25.50;
            $promo->fecha_inicio = '2025-07-01';
            $promo->fecha_fin    = '2025-07-31';
            $promo->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Promoción actualizada correctamente',
                'data'    => $promo
            ], 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al actualizar la promoción',
                'data'    => null,
            ], 300);
        }
    }

    /**
     * Eliminar una promoción por su ID
     */
    public function eliminarPromocion($id)
    {
        try {
            $promo = Promociones::find($id);

            if (is_null($promo)) {
                return response()->json([
                    'status'  => 200,
                    'message' => "No se encontró la promoción con ID $id",
                    'data'    => null
                ], 200);
            }

            $promo->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Promoción eliminada correctamente',
                'data'    => null
            ], 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al eliminar la promoción',
                'error'   => $th->getMessage(),
            ], 300);
        }
    }
}
