<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    //
    protected $table = 'socios';
    protected $fillable = [
        'cedula',
        'id_entidad',
        'carnet',
        'primer_apellido',
        'segundo_apellido',
        'primer_nombre',
        'segundo_nombre',
        'tiposocio',
        'fecha_nacimiento',
        'sexo',
    ];
}
