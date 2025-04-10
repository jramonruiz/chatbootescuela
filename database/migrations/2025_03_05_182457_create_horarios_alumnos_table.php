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
        Schema::create('horarios_alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('id_carrera'); // carrera
            $table->string('id_semestre'); // semestre
            $table->string('id_materia'); // carrera
            $table->text('dia_semana'); 
            $table->text('id_rango_horario')->nullable();  // Cambiamos la columna para que sea nullable es decir no es precio guardar informacion 
            $table->string('id_usuario'); // id profesor
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios_alumnos');
    }

};
