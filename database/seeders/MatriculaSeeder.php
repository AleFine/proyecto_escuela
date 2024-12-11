<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class MatriculaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       //Schema::disableForeignKeyConstraints();

        //DB::table('grados')->truncate();

        $matriculas = [
            ['id_alumno' => 1, 'id_curso' => 1, 'id_grado' => 1, 'id_periodo' => 1, 'id_seccion' => 1],
            ['id_alumno' => 2, 'id_curso' => 1, 'id_grado' => 1, 'id_periodo' => 1, 'id_seccion' => 1],
            ['id_alumno' => 3, 'id_curso' => 1, 'id_grado' => 1, 'id_periodo' => 1, 'id_seccion' => 1],
        ];

        DB::table('matriculas')->insert($matriculas);
    }
}
