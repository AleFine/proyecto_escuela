<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Schema::disableForeignKeyConstraints();

        //DB::table('areas_academicas')->truncate();

        $areas = [
            ['nombre_area' => 'Arte'],
            ['nombre_area' => 'Ciencias'],
            ['nombre_area' => 'Educacion Fisica'],
            ['nombre_area' => 'Humanidades'],
            ['nombre_area' => 'Matematicas'],
            ['nombre_area' => 'Ciencias Fisicas'],
            ['nombre_area' => 'Ciencias Sociales'],
            ['nombre_area' => 'Ciencias Naturales'],
            ['nombre_area' => 'Ciencias Exactas'],
            ['nombre_area' => 'Ciencias de la Salud'],
            ['nombre_area' => 'Psicologia'],
            ['nombre_area' => 'Ciencias de la Computacion'],
            ['nombre_area' => 'Ciencias de la Informacion'],
            ['nombre_area' => 'Educacion'],
            ['nombre_area' => 'Administracion'],
            ['nombre_area' => 'Biologia'],
            ['nombre_area' => 'Ingles'],
        ];

        DB::table('areas_academicas')->insert($areas);
    }
}
