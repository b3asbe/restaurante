<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'id',
        'nombre',
    ];

    public $timestamps = false;
}





















<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'usuario';

 
    protected $primaryKey = 'usuario_id';

 
    public $timestamps = false;


    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'password_usuario',
        'lenguaje_materno',
        'lenguaje_aprender',
        'dni',
    ];
}
