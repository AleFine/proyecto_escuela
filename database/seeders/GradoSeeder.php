<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class GradoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Schema::disableForeignKeyConstraints();

        //DB::table('grados')->truncate();

        $grados = [
            ['id_nivel' => 1, 'nombre_grado' => 'Primero'],
            ['id_nivel' => 1, 'nombre_grado' => 'Segundo'],
            ['id_nivel' => 1, 'nombre_grado' => 'Tercero'],
            ['id_nivel' => 1, 'nombre_grado' => 'Cuarto'],
            ['id_nivel' => 1, 'nombre_grado' => 'Quinto'],
            ['id_nivel' => 1, 'nombre_grado' => 'Sexto'],

            ['id_nivel' => 2, 'nombre_grado' => 'Primero'],
            ['id_nivel' => 2, 'nombre_grado' => 'Segundo'],
            ['id_nivel' => 2, 'nombre_grado' => 'Tercero'],
            ['id_nivel' => 2, 'nombre_grado' => 'Cuarto'],
            ['id_nivel' => 2, 'nombre_grado' => 'Quinto'],
        ];

        DB::table('grados')->insert($grados);
    }
}
