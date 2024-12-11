<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Schema::disableForeignKeyConstraints();

        //DB::table('cursos')->truncate();

        //17 areas
        $cursos = [
            //primer gradito
            ['nombre_curso' => 'Matematica 1', 'id_grado' => 1, 'id_area_academica' => 3],
            ['nombre_curso' => 'Comunicacion 1', 'id_grado' => 1, 'id_area_academica' => 3],
            ['nombre_curso' => 'Razonamiento Matematico 1', 'id_grado' => 1, 'id_area_academica' => 5],
            ['nombre_curso' => 'Razonamiento Verbal 1', 'id_grado' => 1, 'id_area_academica' => 5],

            //segundo gradito
            ['nombre_curso' => 'Matematica Basica', 'id_grado' => 2, 'id_area_academica' => 8],
            ['nombre_curso' => 'Lenguaje', 'id_grado' => 2, 'id_area_academica' => 11],
            ['nombre_curso' => 'Razonamiento M. 2', 'id_grado' => 2, 'id_area_academica' => 12],
            ['nombre_curso' => 'Razonamiento V. 2', 'id_grado' => 2, 'id_area_academica' => 9],

            //tercer gradito
            ['nombre_curso' => 'Geometria Inicial', 'id_grado' => 3, 'id_area_academica' => 16],
            ['nombre_curso' => 'Lenguaje verbal', 'id_grado' => 3, 'id_area_academica' => 11],
            ['nombre_curso' => 'Biologia', 'id_grado' => 3, 'id_area_academica' => 1],
            ['nombre_curso' => 'Religion', 'id_grado' => 3, 'id_area_academica' => 2],

            //cuarto gradito
            ['nombre_curso' => 'Matematica I. 2', 'id_grado' => 4, 'id_area_academica' => 10],
            ['nombre_curso' => 'Lenguaje Aplicado', 'id_grado' => 4, 'id_area_academica' => 12],
            ['nombre_curso' => 'Biologia II', 'id_grado' => 4, 'id_area_academica' => 15],
            ['nombre_curso' => 'Personal Social', 'id_grado' => 4, 'id_area_academica' => 2],

            //quinto gradito
            ['nombre_curso' => 'Matematica Inicial Intermedia', 'id_grado' => 5, 'id_area_academica' => 1],
            ['nombre_curso' => 'Psicologia I', 'id_grado' => 5, 'id_area_academica' => 14],
            ['nombre_curso' => 'Ciencia y Ambiente', 'id_grado' => 5, 'id_area_academica' => 16],
            ['nombre_curso' => 'Historia', 'id_grado' => 5, 'id_area_academica' => 4],

            //sexto gradito (primaria)
            ['nombre_curso' => 'Matematica Final Intermedia', 'id_grado' => 6, 'id_area_academica' => 7],
            ['nombre_curso' => 'Comunicacion Final', 'id_grado' => 6, 'id_area_academica' => 13],
            ['nombre_curso' => 'Ciencia Social', 'id_grado' => 6, 'id_area_academica' => 12],
            ['nombre_curso' => 'Analitica Basica I', 'id_grado' => 6, 'id_area_academica' => 9],

            //primer gradito (secundaria)
            ['nombre_curso' => 'Matematica Intermedia I', 'id_grado' => 7, 'id_area_academica' => 3],
            ['nombre_curso' => 'Lenguaje Avanzado', 'id_grado' => 7, 'id_area_academica' => 5],
            ['nombre_curso' => 'Redaccion de Textos', 'id_grado' => 7, 'id_area_academica' => 10],
            ['nombre_curso' => 'Analitica Basica II', 'id_grado' => 7, 'id_area_academica' => 9],


            //segundo gradito (secundaria)
            ['nombre_curso' => 'Fisica', 'id_grado' => 8, 'id_area_academica' => 15],
            ['nombre_curso' => 'Geometria I', 'id_grado' => 8, 'id_area_academica' => 1],
            ['nombre_curso' => 'Psicologia Comunitaria', 'id_grado' => 8, 'id_area_academica' => 13],
            ['nombre_curso' => 'Analitica Intermedia', 'id_grado' => 8, 'id_area_academica' => 16],

            //tercer gradito (secundaria)
            ['nombre_curso' => 'Fisica II', 'id_grado' => 9, 'id_area_academica' => 5],
            ['nombre_curso' => 'Geometria II', 'id_grado' => 9, 'id_area_academica' => 5],
            ['nombre_curso' => 'Analisis de Textos Avanzado', 'id_grado' => 9, 'id_area_academica' => 12],
            ['nombre_curso' => 'Trigonometria', 'id_grado' => 9, 'id_area_academica' => 5],

            //cuarto gradito (secundaria)
            ['nombre_curso' => 'Matematica Avanzada I', 'id_grado' => 10, 'id_area_academica' => 5],
            ['nombre_curso' => 'Trigonometria II', 'id_grado' => 10, 'id_area_academica' => 5],
            ['nombre_curso' => 'Ingles basico', 'id_grado' => 10, 'id_area_academica' => 17],
            ['nombre_curso' => 'Introduccion a la Investigacion', 'id_grado' => 10, 'id_area_academica' => 4],

            //quinto gradito (secundaria)
            ['nombre_curso' => 'Matematica Avanzada Final', 'id_grado' => 11, 'id_area_academica' => 5],
            ['nombre_curso' => 'Lenguaje Aplicado Avanzado', 'id_grado' => 11, 'id_area_academica' => 2],
            ['nombre_curso' => 'Ingles Avanzado', 'id_grado' => 11, 'id_area_academica' => 17],
            ['nombre_curso' => 'Investigacion Final', 'id_grado' => 11, 'id_area_academica' => 4],
        ];

        DB::table('cursos')->insert($cursos);
    }
}
