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
}
