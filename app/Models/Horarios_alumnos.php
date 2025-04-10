<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horarios_alumnos extends Model
{
    use HasFactory;
    protected $primaryKey ='id';
    protected $fillable = [        
        'id',
        'id_carrera',
        'id_semestre', 
        'id_materia',
        'dia_semana', 
        'id_rango_horario', 
        'id_usuario',
    ];
}
