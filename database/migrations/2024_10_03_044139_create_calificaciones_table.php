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
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->id('id_calificacion');
            $table->enum('calificacion', ['AD','A', 'B', 'C', 'D']);
            $table->foreignId('id_unidad')->references('id_unidad')->on('unidades')->onDelete('cascade');
            $table->foreignId('id_curso')->references('id_curso')->on('cursos')->onDelete('cascade');
            $table->foreignId('id_competencia')->references('id_competencia')->on('competencias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificaciones');
    }
};
