<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosMenus extends Model
{
    use HasFactory;

    protected $table = 'productos_menus';

    // Al ser clave compuesta, desactivamos primaryKey e incrementing
    protected $primaryKey = null;
    public $incrementing  = false;

    protected $fillable = [
        'menu_id',
        'producto_id',
    ];

    public $timestamps = false;
}
