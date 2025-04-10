<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Asegúrate de tener esta línea
use App\Models\Carreras;

class CarrerastableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('carreras')->insert([   
            ['nombre_carrera' => 'Ingenieria en Sistemas Computacionales'],
            ['nombre_carrera' => 'Licenciatura en Informatica'],
        ]);            
    }
}
