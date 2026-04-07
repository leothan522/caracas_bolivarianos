<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoSocio extends Model
{
    //
    protected $table = 'tipo_socio';
    protected $fillable = ['tipo_socio'];

    public function participantes(): HasMany
    {
        return $this->hasMany(Participante::class, 'id_tipo_socio', 'id');
    }

}
