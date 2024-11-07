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
        Schema::create('padres_familia', function (Blueprint $table) {
            $table->id('id_padre_familia');
            $table->string('nombre', 50);
            $table->string('apellido', 50);
            $table->string('dni', 8)->unique();
            $table->string('telefono', 15);
            $table->foreignId('id')->nullable()->references('id')->on('users')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('padres_familia');
    }
};
