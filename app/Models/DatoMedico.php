<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatoMedico extends Model
{
    //
    protected $table = 'datos_medicos';
    protected $fillable = [
        'id_participante',
        'cedula',
        'RH',
        'alergico',
        'ant_medicos',
        'alergias',
        'antecedentes',
        'avisar_a',
        'telefono',
        'obs',
    ];
}
