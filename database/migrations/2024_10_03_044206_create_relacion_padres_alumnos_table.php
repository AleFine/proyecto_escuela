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
        Schema::create('relacion_padres_alumnos', function (Blueprint $table) {
            $table->foreignId('id_padre_familia')->references('id_padre_familia')->on('padres_familia')->onDelete('cascade');
            $table->foreignId('id_alumno')->references('id_alumno')->on('alumnos')->onDelete('cascade');
            $table->primary(['id_padre_familia', 'id_alumno']);  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relacion_padres_alumnos');
    }
};
