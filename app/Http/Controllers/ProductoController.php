<?php

namespace App\Http\Controllers;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class ProductoController extends Controller
{
    public function productos()
    {

        try {
        
       $elementoDB = Productos::all();
   
        if (empty($elementoDB)) {
            return response()->json([
                'status'  => 200,
                'message' => 'No hay datos',
                'data'    => null
            ], 200);
        }

        $dataProductos = [];
        foreach ($elementoDB as $datos) {
            $dataProductos[] = [
                'Nombre'      => $datos->nombre,
                'Descripcion' => $datos->descripcion,
                'Precio'      => $datos->precio,
                'Stock'       => $datos->stock,
            ];
        }

        return response()->json([
            'status'  => 200,
            'message' => 'Información obtenida correctamente',
            'data'    => $dataProductos
        ], 200);
        }
        
        catch(\Throwable $th)
        {
            $mensaje = "Ocurrio un problema";
            return response()->json([
            'status' => 300,
            'message' => $mensaje,
            'data' => null
            ],status:300);
        }
    }


   

//Insertar
public function insertarProducto()
    {
        try {
            $producto = new Productos();
            $producto->nombre      = 'Arrroz con pollooooo';
            $producto->descripcion = 'Arroz con pollito ';
            $producto->precio      = 45.99;
            $producto->stock       = 10;

            $producto->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Producto creado correctamente',
                'data'    => $producto
            ], 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al crear el producto',
                'data'    => null,
            ], 300);
        }
    }

//Actualizar
     public function actualizarProducto($id)
    {
        try {
            $producto = Productos::find($id);

            if (is_null($producto)) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'No se encontro el producto con ID '.$id,
                    'data'    => null
                ], 200);
            }

            // 2) Asignar nuevos valores
            $producto->nombre      = 'ceviche chaufa con pato';
            $producto->descripcion = 'Arroz chaufaa';
            $producto->precio      = 59.99;
            $producto->stock       = 20;


            $producto->save();


            return response()->json([
                'status'  => 200,
                'message' => 'Producto actualizado correctamente',
                'data'    => $producto
            ], 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status'  => 300,
                'message' => 'Error al actualizar el producto',
                'data'    => null,
            ], 300);
        }
    }



    public function eliminarProducto($id)
    {
    try {
      
        $producto = Productos::find($id);

        if (is_null($producto)) {
            return response()->json([
                'status'  => 200,
                'message' => "No se encontro el producto con ID $id",
                'data'    => null
            ], 200);
        }

        $producto->delete();

        return response()->json([
            'status'  => 200,
            'message' => 'Producto eliminado correctamente',
            'data'    => null
        ], 200);
    }
    catch (\Throwable $th) {
        return response()->json([
            'status'  => 300,
            'message' => 'Error al eliminar el producto',
            'error'   => $th->getMessage(),
        ], 300);
    }
    }
}
