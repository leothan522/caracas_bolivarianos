<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Letra extends Model
{
    //
    protected $table = 'letra';
    protected $fillable = [
        'letra',
        'letra_imagen',
    ];
}
