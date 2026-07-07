<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Permiso extends Model
{
    //
    protected $table = 'permisos';
    protected $fillable = [
        'cargos',
        'nombre_permiso',
    ];

    public function niveles(): HasMany
    {
        return $this->hasMany(Nivel::class, 'id_permiso', 'id');
    }

}
