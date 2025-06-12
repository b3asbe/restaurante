<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'productos/listar',
        'productos/insertar',
        'productos/actualizar',
        'productos/eliminar',

        'usuarios/listar',
        'usuarios/insertar',
        'usuarios/actualizar',
        'usuarios/eliminar',

        
        'roles/listar',
        'roles/insertar',
        'roles/actualizar',
        'roles/eliminar',


        'reservas/listar',
        'reservas/insertar',
        'reservas/actualizar',
        'reservas/eliminar',

        
        'promociones/listar',
        'promociones/insertar',
        'promociones/actualizar',
        'promociones/eliminar',

        
        'pedidos/listar',
        'pedidos/insertar',
        'pedidos/actualizar',
        'pedidos/eliminar',

        'caja/listar',
        'caja/por-fecha',

        'estado-pedidos/listar',
        'estado-pedidos/insertar',
        'estado-pedidos/actualizar',
        'estado-pedidos/eliminar',

        'insumos/listar',
        'insumos/insertar',
        'insumos/actualizar',
        'insumos/eliminar',

        'menus/listar',
        'menus/insertar',
        'menus/actualizar',
        'menus/eliminar',

        'mesas/listar',
        'mesas/insertar',
        'mesas/actualizar',
        'mesas/eliminar',

        'movimientos-insumo/listar',
        'movimientos-insumo/insertar',
        'movimientos-insumo/actualizar',
        'movimientos-insumo/eliminar',

        'pedido-productos/listar',
        'pedido-productos/insertar',
        'pedido-productos/actualizar',
        'pedido-productos/eliminar',

        
        'productos-menus/listar',
        'productos-menus/insertar',
        'productos-menus/actualizar',
        'productos-menus/eliminar',

    ];
}
