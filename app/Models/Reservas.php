<?php
// app/Models/Reservas.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    use HasFactory;

    protected $table = 'reservas';

    protected $fillable = [
        'mesa_id',
        'cliente',
        'fecha_reserva',
        'usuario_id',
    ];

    public $timestamps = false;
}
