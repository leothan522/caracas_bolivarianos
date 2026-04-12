<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeporteOficial extends Model
{
    protected $table = 'deportes_oficiales';
    protected $fillable = [
        'proceso',
        'id_deporte',
        'ordenar',
        'categoria',
        'min',
        'max',
        'genero',
        'edad_libre',
        'edad_inicial',
        'edad_final',
        'fecha_libre',
        'fecha_inicial',
        'fecha_final',
    ];

    public function deporte(): BelongsTo
    {
        return $this->belongsTo(Deporte::class, 'id_deporte', 'id');
    }

    public function disciplinas(): HasMany
    {
        return $this->hasMany(ParticipacionDisciplina::class, 'id_deporte_oficial', 'id');
    }

}
