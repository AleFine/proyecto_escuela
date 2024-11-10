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
        Schema::create('profesores', function (Blueprint $table) {
            $table->id('id_profesor');  
            $table->string('nombre');
            $table->string('apellido');
            $table->string('dni', 8)->unique();
            $table->date('fecha_ingreso');
            $table->date('fecha_nacimiento');
            $table->string('direccion', 100);
            $table->string('telefono', 15);
            $table->foreignId('id_area_academica')->references('id_area_academica')->on('areas_academicas')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesores');
    }
};
