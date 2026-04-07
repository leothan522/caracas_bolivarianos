<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Atleta extends Model
{
    //
    protected $table = 'atletas';
    protected $fillable = [
        'id_participante',
        'cedula',
        'id_deporte',
        'id_modalidad',
        'marca',
        'obs',
    ];

    public function participante(): BelongsTo
    {
        return $this->belongsTo(Participante::class, 'id_participante', 'id');
    }

    public function deporte(): BelongsTo
    {
        return $this->belongsTo(Deporte::class, 'id_deporte', 'id');
    }

    public function modalidad(): BelongsTo
    {
        return $this->belongsTo(ModalidadDeportiva::class, 'id_modalidad', 'id');
    }

}
