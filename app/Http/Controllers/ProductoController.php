<?php
// app/Http/Controllers/ProductoController.php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Listar productos
    public function productos(Request $request)
    {
        try {
            $elementos = Productos::all();

            if ($elementos->isEmpty()) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No hay datos',
                    'data'    => null
                ], 200);
            }

            $data = $elementos->map(fn($p) => [
                'id'          => $p->id,
                'nombre'      => $p->nombre,
                'descripcion' => $p->descripcion,
                'precio'      => $p->precio,
                'stock'       => $p->stock,
            ]);

            return response()->json([
                'status'  => 200,
                'message' => 'Información obtenida correctamente',
                'data'    => $data
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al listar productos',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Insertar producto
    public function insertarProducto(Request $request)
    {
        try {
            $datos = $request->validate([
                'nombre'      => 'required|string',
                'descripcion' => 'nullable|string',
                'precio'      => 'required|numeric',
                'stock'       => 'required|integer',
            ]);

            $producto = Productos::create($datos);

            return response()->json([
                'status'  => 200,
                'message' => 'Producto creado correctamente',
                'data'    => $producto
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Error de validación
            return response()->json([
                'status'  => 422,
                'message' => 'Datos inválidos',
                'errors'  => $e->errors()
            ], 422);

        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al crear el producto',
                'error'   => $th->getMessage()
            ], 300);
        }
    }

    // Actualizar producto
    public function actualizarProducto(Request $request)
    {
        try {
            $datos = $request->validate([
                'id'          => 'required|integer|exists:productos,id',
                'nombre'      => 'sometimes|required|string',
                'descripcion' => 'sometimes|nullable|string',
                'precio'      => 'sometimes|required|numeric',
                'stock'       => 'sometimes|required|integer',
            ]);

            $producto = Productos::find($datos['id']);
            $producto->update($request->only(['nombre','descripcion','precio','stock']));

            return response()->json([
                'status'  => 200,
                'message' => 'Producto actualizado correctamente',
                'data'    => $producto
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
                'message' => 'Error al actualizar el producto',
                'error'   => $th->getMessage()
            ], 300);
        }
    }


    public function eliminarProducto(Request $request)
    {
        try {
            $datos = $request->validate([
                'id' => 'required|integer|exists:productos,id',
            ]);

            $producto = Productos::find($datos['id']);
            $producto->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Producto eliminado correctamente',
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
                'message' => 'Error al eliminar el producto',
                'error'   => $th->getMessage()
            ], 300);
        }
    }
}
