<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParticipacionIntencion extends Model
{
    protected $table = 'participacion_intencion';
    protected $fillable = [
        'id_entidad',
        'responsable_club',
        'femenino',
        'masculino',
        'total',
    ];

    public function entidad(): BelongsTo
    {
        return $this->belongsTo(Entidad::class, 'id_entidad', 'id');
    }

}
