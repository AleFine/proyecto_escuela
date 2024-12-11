<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SeccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Schema::disableForeignKeyConstraints();

        //DB::table('secciones')->truncate();

        $secciones = [
            ['nombre_seccion' => 'A', 'aforo' => 15, 'id_grado'=>1],
            ['nombre_seccion' => 'B', 'aforo' => 18, 'id_grado'=>1],
            ['nombre_seccion' => 'C', 'aforo' => 18, 'id_grado'=>1],
            ['nombre_seccion' => 'D', 'aforo' => 18, 'id_grado'=>1],

            ['nombre_seccion' => 'A', 'aforo' => 15, 'id_grado'=>2],
            ['nombre_seccion' => 'B', 'aforo' => 18, 'id_grado'=>2],
            ['nombre_seccion' => 'C', 'aforo' => 18, 'id_grado'=>2],
            ['nombre_seccion' => 'D', 'aforo' => 18, 'id_grado'=>2],

            ['nombre_seccion' => 'A', 'aforo' => 15, 'id_grado'=>3],
            ['nombre_seccion' => 'B', 'aforo' => 18, 'id_grado'=>3],
            ['nombre_seccion' => 'C', 'aforo' => 18, 'id_grado'=>3],
            ['nombre_seccion' => 'D', 'aforo' => 18, 'id_grado'=>3],

            ['nombre_seccion' => 'A', 'aforo' => 15, 'id_grado'=>4],
            ['nombre_seccion' => 'B', 'aforo' => 18, 'id_grado'=>4],
            ['nombre_seccion' => 'C', 'aforo' => 18, 'id_grado'=>4],
            ['nombre_seccion' => 'D', 'aforo' => 18, 'id_grado'=>4],

            ['nombre_seccion' => 'A', 'aforo' => 15, 'id_grado'=>5],
            ['nombre_seccion' => 'B', 'aforo' => 18, 'id_grado'=>5],
            ['nombre_seccion' => 'C', 'aforo' => 18, 'id_grado'=>5],
            ['nombre_seccion' => 'D', 'aforo' => 18, 'id_grado'=>5],

            ['nombre_seccion' => 'A', 'aforo' => 15, 'id_grado'=>6],
            ['nombre_seccion' => 'B', 'aforo' => 18, 'id_grado'=>6],
            ['nombre_seccion' => 'C', 'aforo' => 18, 'id_grado'=>6],
            ['nombre_seccion' => 'D', 'aforo' => 18, 'id_grado'=>6],


            ['nombre_seccion' => 'A', 'aforo' => 15, 'id_grado'=>7],
            ['nombre_seccion' => 'B', 'aforo' => 18, 'id_grado'=>7],
            ['nombre_seccion' => 'C', 'aforo' => 18, 'id_grado'=>7],
            ['nombre_seccion' => 'D', 'aforo' => 18, 'id_grado'=>7],

            ['nombre_seccion' => 'A', 'aforo' => 15, 'id_grado'=>8],
            ['nombre_seccion' => 'B', 'aforo' => 18, 'id_grado'=>8],
            ['nombre_seccion' => 'C', 'aforo' => 18, 'id_grado'=>8],
            ['nombre_seccion' => 'D', 'aforo' => 18, 'id_grado'=>8],

            ['nombre_seccion' => 'A', 'aforo' => 15, 'id_grado'=>9],
            ['nombre_seccion' => 'B', 'aforo' => 18, 'id_grado'=>9],
            ['nombre_seccion' => 'C', 'aforo' => 18, 'id_grado'=>9],
            ['nombre_seccion' => 'D', 'aforo' => 18, 'id_grado'=>9],

            ['nombre_seccion' => 'A', 'aforo' => 15, 'id_grado'=>10],
            ['nombre_seccion' => 'B', 'aforo' => 18, 'id_grado'=>10],
            ['nombre_seccion' => 'C', 'aforo' => 18, 'id_grado'=>10],
            ['nombre_seccion' => 'D', 'aforo' => 18, 'id_grado'=>10],

            ['nombre_seccion' => 'A', 'aforo' => 15, 'id_grado'=>11],
            ['nombre_seccion' => 'B', 'aforo' => 18, 'id_grado'=>11],
            ['nombre_seccion' => 'C', 'aforo' => 18, 'id_grado'=>11],
            ['nombre_seccion' => 'D', 'aforo' => 18, 'id_grado'=>11],
        ];

        DB::table('secciones')->insert($secciones);
    }
}
