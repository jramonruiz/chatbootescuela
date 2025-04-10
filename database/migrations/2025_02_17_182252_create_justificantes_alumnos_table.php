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
        Schema::create('justificantes_alumnos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_alumno'); 
            $table->string('motivo');// (enfermedad, cita médica, etc.)
            $table->date('fecha_emision');
            $table->date('fecha_inicio_justificante');
            $table->date('fecha_fin_justificable');
            $table->string('comentarios');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('justificantes_alumnos');
    }
};
