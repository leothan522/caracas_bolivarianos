<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZonasAcceso extends Model
{
    //
    protected $table = 'zonas_acceso';
    protected $fillable = [
        'zona',
        'autorizacion',
    ];
}
