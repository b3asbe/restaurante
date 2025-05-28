<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
 use HasFactory;


    protected $table = 'usuarios';


    protected $fillable = [
        'id',
        'nombre',
        'correo',
        'contraseña',
        'rol_id',
    ];


    public $timestamps = false;

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }
}
