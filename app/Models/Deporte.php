<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Deporte extends Model
{
    //
    protected $table = 'deportes';
    protected $fillable = [
        'tipo_deporte',
        'codigod',
        'deporte',
        'en_uso',
        'acronimo',
        'ruta_logo',
        'listo',
        'federacion',
        'presidente',
        'url_federacion',
        'email',
        'direccion',
        'telefono',
        'fax',
        'observaciones',
        'url_ranking',
        'clasificatorio',
        'plan',
        'rango_minimo',
        'rango_maximo',
        'secundario',
        'sport',
    ];


    public function participantes(): HasMany
    {
        return $this->hasMany(Participante::class, 'deporteini', 'id');
    }

    public function atletas(): HasMany
    {
        return $this->hasMany(Atleta::class, 'id_deporte', 'id');
    }

    public function modalidades(): HasMany
    {
        return $this->hasMany(ModalidadDeportiva::class, 'id_deporte', 'id');
    }

    public function participacion(): HasMany
    {
        return $this->hasMany(ParticipacionClub::class, 'id_deporte', 'id');
    }

    public function oficiales(): HasMany
    {
        return $this->hasMany(DeporteOficial::class, 'id_deporte', 'id');
    }

}
