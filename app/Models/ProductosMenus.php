<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductosMenus extends Model
{
    protected $table = 'productos_menus';
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;


    public function menu()
    {
        return $this->belongsTo(\App\Models\Menus::class, 'menu_id');
    }

   
    public function producto()
    {
        return $this->belongsTo(\App\Models\Productos::class, 'producto_id');
    }
}
