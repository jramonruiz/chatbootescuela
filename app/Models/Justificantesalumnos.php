<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Justificantesalumnos extends Model
{
    use HasFactory;
    protected $primaryKey ='id';
    protected $fillable = [        
        'id',
        'id_alumno', 
        'motivo',
        'fecha_emision',
        'fecha_inicio_justificante',
        'fecha_fin_justificable',
        'comentarios',            
    ];
}
