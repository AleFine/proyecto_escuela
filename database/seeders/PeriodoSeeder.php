<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class PeriodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Schema::disableForeignKeyConstraints();
        //DB::table('periodos')->truncate();
        $periodos = [
            ['nombre_periodo' => '2022', 'fecha_inicio' => Carbon::create(2024, 03, 15), 'fecha_fin' => Carbon::create(2024, 12, 16)],
            ['nombre_periodo' => '2023', 'fecha_inicio' => Carbon::create(2023, 03, 14), 'fecha_fin' => Carbon::create(2023, 12, 18)],
            ['nombre_periodo' => '2024', 'fecha_inicio' => Carbon::create(2024, 03, 8), 'fecha_fin' =>  Carbon::create(2024, 12, 8)],
        ];

        DB::table('periodos')->insert($periodos);
    }
}
