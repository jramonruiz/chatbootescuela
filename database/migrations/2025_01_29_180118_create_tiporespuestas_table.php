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
        Schema::create('tiporespuestas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tipo_usuario');
            $table->text('descripcion_respuesta');
            $table->text('descripcion_respuesta_chatboot');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiporespuestas');
    }
};
