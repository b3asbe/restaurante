<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoProductos extends Model
{
    use HasFactory;

    protected $table = 'pedido_productos';

    // Desactivar primaryKey e incrementing para clave compuesta
    protected $primaryKey = null;
    public $incrementing  = false;

    protected $fillable = [
        'pedido_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
    ];

    public $timestamps = false;
}
