<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientosInsumo extends Model
{
    use HasFactory;

    // Forzamos el nombre de la tabla a "movimientos_insumo"
    protected $table = 'movimientos_insumo';

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'id',
        'insumo_id',
        'cantidad',
        'tipo',
        'fecha',
    ];

    // La tabla NO tiene columnas created_at / updated_at
    public $timestamps = false;
}
