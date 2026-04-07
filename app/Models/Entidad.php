<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Entidad extends Model
{
    //
    protected $table = 'estados';
    protected $fillable = [
        'codigoe',
        'nombre',
        'short_nombre',
        'capital',
        'ruta_bandera',
        'ruta_escudo',
        'activo',
        'is_delegacion',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'id_entidad', 'id');
    }

    public function participantes(): HasMany
    {
        return $this->hasMany(Participante::class, 'id_entidad', 'id');
    }

    public function participacion(): HasMany
    {
        return $this->hasMany(ParticipacionClub::class, 'id_entidad', 'id');
    }

    public function intencion(): HasOne
    {
        return $this->hasOne(ParticipacionIntencion::class, 'id_entidad', 'id');
    }

    public function disciplinas(): HasMany
    {
        return $this->hasMany(ParticipacionDisciplina::class, 'id_entidad', 'id');
    }

}
