<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;
    protected $primaryKey ='id';
    protected $fillable = [
        'id',
        'nombre_completo',
        'username',
        'clave',
        'numero_telefono',
        'email',
        'id_tipo_usuario',
        'activo',
        'apikey',
        'inicia',
        'termina',
        'direccion',
        'codigo_postal',
        'pais',
        'estado',
        'ciudad',
        'nombre_compania',
        'url_compania',
        'clave_desencriptada',
    ];
}
