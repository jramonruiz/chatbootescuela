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
        Schema::create('calificaciones_alumnos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_alumno'); //(clave foránea de la tabla de Alumnos)
            $table->integer('id_materia'); //(clave foránea de la tabla de Materias)
            $table->integer('id_grado'); //(clave foránea de la tabla de Materias)
            $table->decimal('calificacion', 5, 2); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificaciones_alumnos');
    }
};
