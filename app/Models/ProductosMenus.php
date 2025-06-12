<?php
// app/Models/ProductosMenus.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosMenus extends Model
{
    use HasFactory;

    protected $table      = 'productos_menus';
    public    $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'menu_id',
        'producto_id',
    ];

    public $timestamps = false;

    public function menu()
    {
        return $this->belongsTo(\App\Models\Menus::class, 'menu_id');
    }

    public function producto()
    {
        return $this->belongsTo(\App\Models\Productos::class, 'producto_id');
    }
}
