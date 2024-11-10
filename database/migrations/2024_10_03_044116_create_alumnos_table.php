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
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id('id_alumno');  // Clave primaria
            $table->string('nombre');
            $table->string('apellido');
            $table->string('dni', 8)->unique();
            $table->date('fecha_nacimiento');
            $table->string('genero', 10);
            $table->string('region', 50);
            $table->string('ciudad', 50);
            $table->string('distrito', 50);
            $table->string('telefono', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
