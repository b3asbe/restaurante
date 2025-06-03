<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promociones extends Model
{
    use HasFactory;

    protected $table = "promociones";

    protected $fillable = [
        'id',
        'nombre',
        'descuento',
        'fecha_inicio',
        'fecha_fin',
    ];
    public $timestamps = false;
}
