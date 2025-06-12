<?php
// app/Http/Controllers/ReservasController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservas;

class ReservasController extends Controller
{
    // Listar todas las reservas
    public function reservas(Request $request)
    {
        try {
            $todas = Reservas::all();
            if ($todas->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay reservas registradas',
                    'data'    => null
                ], 200);
            }

            $data = $todas->map(fn($r) => [
                'id'            => $r->id,
                'mesa_id'       => $r->mesa_id,
                'cliente'       => $r->cliente,
                'fecha_reserva' => $r->fecha_reserva,
                'usuario_id'    => $r->usuario_id,
            ]);

            return response()->json([
                'status'  => 200,
                'message' => 'Reservas obtenidas correctamente',
                'data'    => $data
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Ocurrió un problema al listar las reservas',
                'error'   => $th->getMessage(),
            ], 300);
        }
    }

    // Insertar una nueva reserva
    public function insertarReserva(Request $request)
    {
        try {
            $datos = $request->validate([
                'mesa_id'       => 'required|integer|exists:mesas,id',
                'cliente'       => 'required|string',
                'fecha_reserva' => 'required|date_format:Y-m-d H:i:s',
                'usuario_id'    => 'required|integer|exists:usuarios,id',
            ]);

            $reserva = Reservas::create($datos);

            return response()->json([
                'status'  => 200,
                'message' => 'Reserva creada correctamente',
                'data'    => $reserva
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
                'message' => 'Error al crear la reserva',
                'error'   => $th->getMessage(),
            ], 300);
        }
    }

    // Actualizar una reserva
    public function actualizarReserva(Request $request)
    {
        try {
            $datos = $request->validate([
                'id'             => 'required|integer|exists:reservas,id',
                'mesa_id'        => 'sometimes|required|integer|exists:mesas,id',
                'cliente'        => 'sometimes|required|string',
                'fecha_reserva'  => 'sometimes|required|date_format:Y-m-d H:i:s',
                'usuario_id'     => 'sometimes|required|integer|exists:usuarios,id',
            ]);

            $reserva = Reservas::find($datos['id']);
            $reserva->update($request->only(['mesa_id','cliente','fecha_reserva','usuario_id']));

            return response()->json([
                'status'  => 200,
                'message' => 'Reserva actualizada correctamente',
                'data'    => $reserva
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
                'message' => 'Error al actualizar la reserva',
                'error'   => $th->getMessage(),
            ], 300);
        }
    }

    // Eliminar una reserva
    public function eliminarReserva(Request $request)
    {
        try {
            $datos = $request->validate([
                'id' => 'required|integer|exists:reservas,id',
            ]);

            $reserva = Reservas::find($datos['id']);
            $reserva->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Reserva eliminada correctamente',
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
                'message' => 'Error al eliminar la reserva',
                'error'   => $th->getMessage(),
            ], 300);
        }
    }
}
