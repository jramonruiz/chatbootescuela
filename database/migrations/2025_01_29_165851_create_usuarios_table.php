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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_completo');
            $table->string('username');
            $table->string('clave');
            $table->string('numero_telefono');
            $table->string('email');
            $table->integer('id_tipo_usuario');
            $table->integer('activo');
            $table->string('apikey');
            $table->date('inicia');
            $table->date('termina');
            $table->string('direccion');
            $table->string('codigo_postal');
            $table->string('pais');
            $table->string('estado');
            $table->string('ciudad');
            $table->string('nombre_compania');
            $table->string('url_compania');
            $table->text('clave_desencriptada');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
