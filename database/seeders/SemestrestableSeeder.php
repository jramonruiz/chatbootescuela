<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Asegúrate de tener esta línea
use App\Models\Semestres;

class SemestrestableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //
        DB::table('semestres')->insert([   
            ['descripcion_semestre' => '1'],
            ['descripcion_semestre' => '2'],
            ['descripcion_semestre' => '3'],
            ['descripcion_semestre' => '4'],
            ['descripcion_semestre' => '5'],
            ['descripcion_semestre' => '6'],
            ['descripcion_semestre' => '7'],
            ['descripcion_semestre' => '8'],
            ['descripcion_semestre' => '9'],
            ['descripcion_semestre' => '10'],
            ['descripcion_semestre' => '11'],
            ['descripcion_semestre' => '12'],
            ['descripcion_semestre' => '13'],
            ['descripcion_semestre' => '14'],
        ]);            
    }
}
