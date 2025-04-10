<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
    use HasFactory;
    protected $primaryKey ='id';
    protected $fillable = [        
        'id',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
        'sexo',
        'correo_electronico',
        'telefono',
        'direccion',
        'matricula', 
        'fecha_ingreso',
        'estado', 
        'carrera',
        'semestre',
        'estatus', 
    ];
}
