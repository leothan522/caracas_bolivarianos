<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoluntarioArea extends Model
{
    //
    protected $table = 'voluntario_areas';
    protected $fillable = [
        'cedula',
        'cod_area',
    ];
}
