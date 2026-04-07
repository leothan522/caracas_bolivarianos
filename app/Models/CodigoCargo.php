<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodigoCargo extends Model
{
    //
    protected $table = 'codigo_cargo';
    protected $fillable = [
        'cod_cargo',
        'descripcion_cargo',
        'logo',
    ];
}
