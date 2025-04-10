<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Asegúrate de tener esta línea
use App\Models\Rangohorarios;

class RangohorariostableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //
        DB::table('rangohorarios')->insert([   
            ['descripcion_rango_horario' => '07:50 - 08:40'],
            ['descripcion_rango_horario' => '08:40 - 09:30'],
            ['descripcion_rango_horario' => '09:50 - 10:40'],
            ['descripcion_rango_horario' => '10:40 - 11:30'],
            ['descripcion_rango_horario' => '11:30 - 12:20'],
            ['descripcion_rango_horario' => '12:20 - 13:10'],
        ]);            
    }
}
