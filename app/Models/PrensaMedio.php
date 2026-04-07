<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrensaMedio extends Model
{
    //
    protected $table = 'prensa_medios';
    protected $fillable = [
        'id_entidad',
        'id_tipo_medio',
        'nombre_medio',
    ];
}
