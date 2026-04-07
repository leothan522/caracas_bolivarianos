<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDeporte extends Model
{
    //
    protected $table = 'tipo_deporte';
    protected $fillable = [
        'descripcion',
        'nombre',
    ];
}
