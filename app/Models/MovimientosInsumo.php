<?php
// app/Models/MovimientosInsumo.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientosInsumo extends Model
{
    use HasFactory;

    protected $table = 'movimientos_insumo';

    protected $fillable = [
        'insumo_id',
        'cantidad',
        'tipo',
        'fecha',
    ];

    public $timestamps = false;
}
