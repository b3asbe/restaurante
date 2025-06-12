<?php
// app/Models/Mesas.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesas extends Model
{
    use HasFactory;

    protected $table = 'mesas';

    protected $fillable = [
        'numero',
        'capacidad',
    ];

    public $timestamps = false;
}
