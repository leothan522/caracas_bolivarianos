<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seguridad extends Model
{
    //
    protected $table = 'seguridad';
    protected $fillable = [
        'cod_seguridad',
        'color_seguridad',
        'permisos',
        'nombre_seguridad',
        'color_cmyk',
        'color_rgb',
        'color_letra',
    ];
}
