<?php
// app/Models/Pedidos.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'usuario_id',
        'mesa_id',
        'estado_id',
        'fecha_entrega',
    ];

    public $timestamps = false;
}
