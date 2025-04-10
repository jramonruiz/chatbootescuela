<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Asegúrate de tener esta línea
use Illuminate\Support\Facades\Hash;
use App\Models\Usuarios;

class UsuariostableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //     
        DB::table('usuarios')->insert([
            ['nombre_completo' => 'Jose Ramon Ruiz Torres',
            'username' => 'jramon',
            'clave' => Hash::make('Monchogro$$$***'),
            'numero_telefono' => '9631599269',
            'email' => 'jramonruiz@gmail.com',
            'id_tipo_usuario' => 1,
            'activo' => 1,
            'apikey' => 'jramonplGojuzuohCwqG8XrRe9',
            'inicia' => '2025-01-31',
            'termina' => '2025-01-31',
            'direccion' => '',
            'codigo_postal' => '',
            'pais' => '',
            'estado' => '',
            'ciudad' => '',
            'nombre_compania' => '',
            'url_compania' => '',
            'created_at' => now(),
            'updated_at' => now(),
            'clave_desencriptada' => 'Monchogro$$$***'
            ],
            ['nombre_completo' => 'Jaimito Cleofas3',
            'username' => 'jaimito',
            'clave' => Hash::make('123456'),
            'numero_telefono' => '9631234567',
            'email' => 'jaimito@gmail.com',
            'id_tipo_usuario' => 2,
            'activo' => 1,
            'apikey' => 'jaimitomTh1H77jxIsEHVcX4Owu',
            'inicia' => '2025-01-31',
            'termina' => '2025-01-31',
            'direccion' => 'direccion de jamito',
            'codigo_postal' => '30000',
            'pais' => '',
            'estado' => 'Chiapas',
            'ciudad' => 'Comitan',
            'nombre_compania' => 'Escuela de jaimito',
            'url_compania' => 'www.jaimitio.com',
            'created_at' => now(),
            'updated_at' => now(),
            'clave_desencriptada' => '123456'
            ],    
        ]);        
    }
}
