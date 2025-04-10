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
        Schema::create('tareas_alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo'); // Título de la tarea
            $table->text('descripcion')->nullable(); // Descripción de la tarea (opcional)
            $table->text('archivo')->nullable(); // ruta del archivo pdf, doc, etc.
            $table->string('id_semestre'); // semestre
            $table->string('id_materia'); // carrera
            $table->string('id_carrera'); // carrera
            $table->string('id_usuario'); // id profesor
            $table->date('fecha_entrega'); // Fecha y hora de entrega     
            $table->string('estado'); //(activo/inactivo)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas_alumnos');
    }
};
