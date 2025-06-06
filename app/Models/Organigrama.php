<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organigrama extends Model
{
    use HasFactory;

    protected $table = 'organigrama';

    protected $fillable = [
        'id',
        'nombre',
        'parent_id',
    ];

    public $timestamps = false;
}
