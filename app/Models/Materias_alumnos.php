<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materias_alumnos extends Model
{
    use HasFactory;
    protected $primaryKey ='id';
    protected $fillable = [        
        'id',
        'clave_materia',
        'nombre_materia', 
        'descripcion_materia',
        'creditos', 
        'carrera', 
        'semestre',
    ];
}
