<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participante extends Model
{
    //
    use SoftDeletes;
    protected $table = 'participantes';
    protected $fillable = [
        'cedula',
        'id_entidad',
        'id_entidad_responsable',
        'id_cargo',
        'status_acreditacion',
        'primer_apellido',
        'segundo_apellido',
        'primer_nombre',
        'segundo_nombre',
        'sexo',
        'fecha_nacimiento',
        'fecha_activacion',
        'direccion',
        'cod_postal',
        'telefono',
        'celular',
        'usa_transporte',
        'cod_transporte',
        'PIN',
        'fotografia',
        'asiste',
        'email',
        'facultad',
        'ano_ingreso',
        'carrera',
        'semestre',
        'deporteini',
        'fechaemipas',
        'fechavenpas',
        'lugaremipas',
        'uniforme',
        'calzado',
        'peso',
        'talla',
        'edad',
        'image_cedula',
        'carnet_socio',
        'id_tipo_socio',
        'rh',
        'alergico',
        'ant_medicos',
        'alergias',
        'antecedentes',
        'avisar_a',
        'telefono_medico',
        'obs_medicas',
    ];

    public function deporteinicial(): BelongsTo
    {
        return $this->belongsTo(Deporte::class, 'deporteini', 'id');
    }

    public function cargo(): BelongsTo
    {
        return $this->belongsTo(Cargo::class, 'id_cargo', 'id');
    }

    public function entidad(): BelongsTo
    {
        return $this->belongsTo(Entidad::class, 'id_entidad', 'id');
    }

    public function tipoSocio(): BelongsTo
    {
        return $this->belongsTo(TipoSocio::class, 'id_tipo_socio', 'id');
    }

    public function atletas(): HasMany
    {
        return $this->hasMany(Atleta::class, 'id_participante', 'id');
    }

    protected static function booted(): void
    {
        static::updating(function ($participante) {
            // 1. Verificamos si cambiaron específicamente estos campos en el modelo
            $cambioFecha = $participante->isDirty('fecha_nacimiento');
            $cambioSexo  = $participante->isDirty('sexo');
            $cambioCargo = $participante->isDirty('id_cargo');

            // 2. Solo si alguno de los tres cambió, ejecutamos el borrado directo
            if ($cambioFecha || $cambioSexo || $cambioCargo) {
                \App\Models\Atleta::where('id_participante', $participante->id)->delete();
            }
        });
    }

}
