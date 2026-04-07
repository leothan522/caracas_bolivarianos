<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voluntario extends Model
{
    //
    protected $table = 'voluntarios';
    protected $fillable = [
        'id_participante',
        'cedula',
        'experiencia_deporte',
        'profesion',
        'experiencia_juegos',
        'internet',
        'apoyo_medico',
    ];
}
