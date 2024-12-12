<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $competencias = [
            ['nombre_competencia'=> 'Se desenvuelve magnificamente'],
            ['nombre_competencia'=> 'Aprende rapido y seguro'],
            ['nombre_competencia'=> 'Logra sus objetivos con facilidad'],
        ];
        DB::table('competencias')->insert($competencias);
    }
}
