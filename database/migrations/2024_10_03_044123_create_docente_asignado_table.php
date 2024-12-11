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
        Schema::create('docente_asignado', function (Blueprint $table) {
            $table->id('id_docente_asignado');
            $table->foreignId('id_profesor')->references('id_profesor')->on('profesores')->onDelete('cascade');
            $table->foreignId('id_seccion')->references('id_seccion')->on('secciones')->onDelete('cascade');
            $table->foreignId('id_periodo')->references('id_periodo')->on('periodos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docente_asignado');
    }
};
