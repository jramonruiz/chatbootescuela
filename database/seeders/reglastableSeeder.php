<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Asegúrate de tener esta línea
use App\Models\Reglas;

class reglastableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('reglas')->insert([   
        ['numero_pregunta' => 1, 
        'descripcion_pregunta' => 'Descargar boleta de calificaciones', 
        'tipo_respuesta' => '4', 
        'description_respuesta' => 'Tu boleta lo puedes consultar y descargar en el siguiente link: <a href=\'www.boleta.com\'>www.boleta.com</a>', 
        'url_respuestas' => 'boleta_calificaciones', 
        'created_at' => now(), 
        'updated_at' => now()
        ],
        ['numero_pregunta' => 2, 
        'descripcion_pregunta' => 'Descargar constancia de calificaciones', 
        'tipo_respuesta' => '4', 
        'description_respuesta' => 'Tu constancia de calificaciones lo puedes consultar y descargar en el siguiente link: <a href=\'www.boleta.com\'>www.boleta.com</a>', 
        'url_respuestas' => 'constancia_calificaciones', 
        'created_at' => now(), 
        'updated_at' => now()
        ],
        ['numero_pregunta' => 3, 
        'descripcion_pregunta' => 'Descargar Kardex de calificaciones', 
        'tipo_respuesta' => '4', 
        'description_respuesta' => 'Tu Kardex de calificaciones lo puedes consultar y descargar en el siguiente link: <a href=\'www.boleta.com\'>www.boleta.com</a>', 
        'url_respuestas' => 'kardex_calificaciones', 
        'created_at' => now(), 
        'updated_at' => now()
        ],
        ['numero_pregunta' => 4, 
        'descripcion_pregunta' => 'Descargar horario de clases', 
        'tipo_respuesta' => '4', 
        'description_respuesta' => 'Tu Horario de clases lo puedes consultar y descargar en el siguiente link: <a href=\'www.boleta.com\'>www.boleta.com</a>', 
        'url_respuestas' => 'horario_clases', 
        'created_at' => now(), 
        'updated_at' => now()
        ],
        ['numero_pregunta' => 5, 
        'descripcion_pregunta' => 'Descargar Justificante', 
        'tipo_respuesta' => '4', 
        'description_respuesta' => 'Tu Justificante lo puedes consultar y descargar en el siguiente link: <a href=\'www.boleta.com\'>www.boleta.com</a>', 
        'url_respuestas' => 'justificante_alumno', 
        'created_at' => now(), 
        'updated_at' => now()
        ],
    ]);        
    }
}
