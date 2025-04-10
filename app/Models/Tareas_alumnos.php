<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tareas_alumnos extends Model
{
    use HasFactory;
    protected $primaryKey ='id';
    protected $fillable = [        
        'id',
        'titulo',
        'descripcion',
        'archivo',
        'id_semestre',
        'id_materia',
        'id_carrera',
        'id_usuario',
        'fecha_entrega',
        'estado', 
    ];
}
