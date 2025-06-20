<?php
// app/Models/Caja.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;

    protected $table = 'cierres_caja';

    protected $fillable = [
        'fecha',
        'total',
        'usuario_id',
    ];

    public $timestamps = false;
}
