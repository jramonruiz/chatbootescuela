<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('materias_alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('clave_materia'); //(código único de la materia)
            $table->string('nombre_materia'); 
            $table->string('descripcion_materia'); //(breve descripción de la materia)
            $table->string('creditos'); //(cantidad de créditos de la materia)
            $table->string('carrera'); //(relacionado con la carrera o programas de estudio)
            $table->string('semestre'); // (semestre en el que se ofrece)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materias_alumnos');
    }
};
