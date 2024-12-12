<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unidades = [
            ['nombre_unidad' => 'UNIDAD I','id_periodo'=>3,'orden'=>1],
            ['nombre_unidad' => 'UNIDAD II','id_periodo'=>3,'orden'=>2],
            ['nombre_unidad' => 'UNIDAD III','id_periodo'=>3,'orden'=>3],
        ];

        DB::table('unidades')->insert($unidades);
    }
}
