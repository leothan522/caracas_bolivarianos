<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcreditacionVehiculo extends Model
{
    //
    protected $table = 'acreditacion_vehiculos';
    protected $fillable = [
        'id_ente',
        'id_entidad',
        'placa_vehiculo',
        'color_banda',
        'serial_asignado',
        'cedula_chofer',
        'nombre_chofer',
    ];
}
