<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParticipacionDisciplina extends Model
{
    protected $table = 'participacion_intencion_disciplinas';
    protected $fillable = [
        'id_entidad',
        'id_deporte_oficial',
        'femenino',
        'masculino',
    ];

    public function entidad(): BelongsTo
    {
        return $this->belongsTo(Entidad::class, 'id_entidad', 'id');
    }

    public function deporte(): BelongsTo
    {
        return $this->belongsTo(DeporteOficial::class, 'id_deporte_oficial', 'id');
    }

}
