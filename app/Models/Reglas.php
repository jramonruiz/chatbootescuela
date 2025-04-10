<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reglas extends Model
{
    use HasFactory;
    protected $primaryKey ='id';
    protected $fillable = [
        'id',
        'numero_pregunta',
        'descripcion_pregunta',
        'tipo_respuesta',
        'description_respuesta',
        'url_respuestas',
    ];
}
