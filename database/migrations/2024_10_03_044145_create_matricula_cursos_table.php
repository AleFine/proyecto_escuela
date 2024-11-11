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
        Schema::create('matricula_cursos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_curso');
            $table->unsignedBigInteger('id_matricula');
            $table->foreign('id_curso')->references('id_curso')->on('cursos')->onDelete('cascade');
            $table->foreign('id_matricula')->references('id_matricula')->on('matriculas')->onDelete('cascade');
            $table->primary(['id_curso', 'id_matricula']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matricula_cursos');
    }
};
