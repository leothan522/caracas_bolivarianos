<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nivel extends Model
{
    //
    protected $table = 'niveles';
    protected $fillable = [
        'id_nivel',
        'id_permiso',
        'nivel',
        'activo',
    ];
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'id_nivel', 'id');
    }

}
