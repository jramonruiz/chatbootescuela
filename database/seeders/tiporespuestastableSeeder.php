<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Asegúrate de tener esta línea
use App\Models\Tiporespuestas;

class tiporespuestastableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('tiporespuestas')->insert([            
        ['id_tipo_usuario' => 4,
        'descripcion_respuesta' => 'boleta_calificaciones',
        'descripcion_respuesta_chatboot' => 'Para consultar  y descargar la boleta de calificaciones del alumnos',
        'created_at' => now(),
        'updated_at' => now(),
        'respuesta_completa' => 'Boleta de calificaciones'
        ],
        ['id_tipo_usuario' => 4,
        'descripcion_respuesta' => 'constancia_calificaciones',
        'descripcion_respuesta_chatboot' => 'Para consultar y descargar la constancia de calificaciones del alumnos',
        'created_at' => now(),
        'updated_at' => now(),
        'respuesta_completa' => 'Constancia de calificaciones'
        ],
        ['id_tipo_usuario' => 4,
        'descripcion_respuesta' => 'kardex_calificaciones',
        'descripcion_respuesta_chatboot' => 'Para consultar y descargar el kardex de calificaciones del alumnos',
        'created_at' => now(),
        'updated_at' => now(),
        'respuesta_completa' => 'Kardex de calificaciones'
        ],
        ['id_tipo_usuario' => 4,
        'descripcion_respuesta' => 'horario_clases',
        'descripcion_respuesta_chatboot' => 'Para consultar y descargar horario de clases del alumnos',
        'created_at' => now(),
        'updated_at' => now(),
        'respuesta_completa' => 'Horario de clases'
        ],
        ['id_tipo_usuario' => 4,
        'descripcion_respuesta' => 'justificante_alumno',
        'descripcion_respuesta_chatboot' => 'Para consultar y descargar justificante del alumnos',
        'created_at' => now(),
        'updated_at' => now(),
        'respuesta_completa' => 'Justificante alumno'
        ],
        ['id_tipo_usuario' => 3,
        'descripcion_respuesta' => 'oficio_para_docentes_y_administrativos003',
        'descripcion_respuesta_chatboot' => 'Este es un oficio dirigido para docentes y administrativos 003',
        'created_at' => now(),
        'updated_at' => now(),
        'respuesta_completa' => 'Oficio para docentes y administrativos003'
        ],
    ]);        
    }
}
