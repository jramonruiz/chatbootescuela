<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiporespuestas extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'id_tipo_usuario',
        'descripcion_respuesta',
        'descripcion_respuesta_chatboot',
    ];
}

