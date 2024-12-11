<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class NivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Schema::disableForeignKeyConstraints();

        //DB::table('niveles')->truncate();

        $niveles = [
            ['nombre_nivel' => 'Primaria', 'turno' => 'Mañana'],
            ['nombre_nivel' => 'Secundaria', 'turno' => 'Mañana'],
        ];

        DB::table('niveles')->insert($niveles);
    }
}
