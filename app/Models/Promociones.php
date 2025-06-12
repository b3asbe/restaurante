<?php
// app/Models/Promociones.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promociones extends Model
{
    use HasFactory;

    protected $table = 'promociones';

    protected $fillable = [
        'nombre',
        'descuento',
        'fecha_inicio',
        'fecha_fin',
    ];

    public $timestamps = false;
}

