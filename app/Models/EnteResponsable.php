<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnteResponsable extends Model
{
    //
    protected $table = 'entes_responsables';
    protected $fillable = [
        'nombre_ente',
    ];
}
