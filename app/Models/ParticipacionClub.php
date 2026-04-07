<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParticipacionClub extends Model
{
    protected $table = 'participacion_club';
    protected $fillable = [
        'id_entidad',
        'id_deporte',
        'id_modalidad',
        'intencion',
        'num_atl_fem',
        'num_atl_mas',
        'num_ent_fem',
        'num_ent_mas',
        'num_del_fem',
        'num_del_mas',
        'num_arb_fem',
        'num_arb_mas',
        'num_ofi_fem',
        'num_ofi_mas',
        'num_total_fem',
        'num_total_mas',
        'num_total',
    ];

    public function entidad(): BelongsTo
    {
        return $this->belongsTo(Entidad::class, 'id_entidad', 'id');
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
