<?php
// app/Models/EstadoPedidos.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoPedidos extends Model
{
    use HasFactory;

    protected $table = 'estados_pedido';

    protected $fillable = [
        'nombre',
    ];

    public $timestamps = false;
}
