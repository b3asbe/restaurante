<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservas;

class ReservasController extends Controller
{
    /**
     * Listar todas las reservas
     */
    public function reservas()
    {
        try {
            $elementoDB = Reservas::all();

            if ($elementoDB->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay reservas registradas',
                    'data'    => null
                ], 200);
            }

            // Preparar salida
            $dataReservas = [];
            foreach ($elementoDB as $reserva) {
                $dataReservas[] = [
                    'ID'            => $reserva->id,
                    'MesaID'        => $reserva->mesa_id,
                    'Cliente'       => $reserva->cliente,
                    'FechaReserva'  => $reserva->fecha_reserva,
                    'UsuarioID'     => $reserva->usuario_id,
                ];
            }

            return response()->json([
                'status'  => 200,
                'message' => 'Reservas obtenidas correctamente',
                'data'    => $dataReservas
            ], 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Ocurrió un problema al listar las reservas',
                'data'    => null,
            ], 300);
        }
    }

    /**
     * Insertar una nueva reserva (ejemplo hardcodeado)
     */
    public function insertarReserva()
    {
        try {
            $nueva = new Reservas();
            $nueva->mesa_id        = 1;                          // Ejemplo: mesa con ID 1
            $nueva->cliente        = 'Juan Diego';               // Ejemplo de nombre de cliente
            $nueva->fecha_reserva  = '2025-06-10 20:00:00';      // Ejemplo de fecha/hora de reserva
            $nueva->usuario_id     = 1;                          // Ejemplo: usuario con ID 1
            $nueva->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Reserva creada correctamente',
                'data'    => $nueva
            ], 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al crear la reserva',
                'data'    => null,
            ], 300);
        }
    }

    /**
     * Actualizar una reserva por su ID
     */
    public function actualizarReserva($id)
    {
        try {
            $reserva = Reservas::find($id);

            if (is_null($reserva)) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No se encontró la reserva con ID ' . $id,
                    'data'    => null
                ], 200);
            }

            // Ejemplo de nuevos valores (puedes reemplazar por datos de $request)
            $reserva->mesa_id       = 2;                         // Cambiamos a la mesa con ID 2
            $reserva->cliente       = 'Marta González';           // Nuevo cliente
            $reserva->fecha_reserva = '2025-06-11 21:30:00';      // Nueva fecha/hora
            $reserva->usuario_id    = 2;                         // Usuario con ID 2
            $reserva->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Reserva actualizada correctamente',
                'data'    => $reserva
            ], 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al actualizar la reserva',
                'data'    => null,
            ], 300);
        }
    }

    /**
     * Eliminar una reserva por su ID
     */
    public function eliminarReserva($id)
    {
        try {
            $reserva = Reservas::find($id);

            if (is_null($reserva)) {
                return response()->json([
                    'status'  => 200,
                    'message' => "No se encontró la reserva con ID $id",
                    'data'    => null
                ], 200);
            }

            $reserva->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Reserva eliminada correctamente',
                'data'    => null
            ], 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al eliminar la reserva',
                'error'   => $th->getMessage(),
            ], 300);
        }
    }
}
