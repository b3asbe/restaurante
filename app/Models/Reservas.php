<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    use HasFactory;

    // Apuntamos al nombre de la tabla real
    protected $table = 'reservas';

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'id',
        'mesa_id',
        'cliente',
        'fecha_reserva',
        'usuario_id',
    ];

    // Si la tabla NO tiene columnas created_at / updated_at
    public $timestamps = false;
}
