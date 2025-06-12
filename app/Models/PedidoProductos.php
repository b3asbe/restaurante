<?php
// app/Models/PedidoProductos.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoProductos extends Model
{
    use HasFactory;

    protected $table      = 'pedido_productos';
    public $incrementing  = false;
    protected $primaryKey = null;

    protected $fillable = [
        'pedido_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
    ];

    public $timestamps = false;
}
