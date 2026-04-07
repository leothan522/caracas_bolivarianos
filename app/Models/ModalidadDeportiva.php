<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModalidadDeportiva extends Model
{
    //
    protected $table = 'modalidad_deportiva';
    protected $fillable = [
        'id_deporte',
        'codigod',
        'codigo_modalidad',
        'modalidad',
        'masculino',
        'femenino',
        'puntuable',
        'en_practica',
        'rango_minimo',
        'rango_maximo',
        'observaciones',
        'es_equipo',
        'modality',
        'IdModalAccess',
        'IdCategAccess',
        'Orden',
    ];

    public function deporte(): BelongsTo
    {
        return $this->belongsTo(Deporte::class, 'id_deporte', 'id');
    }

    public function atletas(): HasMany
    {
        return $this->hasMany(Atleta::class, 'id_modalidad', 'id');
    }

    public function participacion(): HasMany
    {
        return $this->hasMany(ParticipacionClub::class, 'id_modalidad', 'id');
    }


}
