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
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id('id_matricula');
            $table->foreignId('id_alumno')->references('id_alumno')->on('alumnos')->onDelete('cascade');  
            $table->foreignId('id_curso')->references('id_curso')->on('cursos')->onDelete('cascade');    
            $table->foreignId('id_periodo')->references('id_periodo')->on('periodos')->onDelete('cascade');  
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->timestamps();
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
