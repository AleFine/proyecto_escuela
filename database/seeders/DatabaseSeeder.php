<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RegionesSeeder::class,
            CompetenciaSeeder::class,
            PeriodoSeeder::class,
            AlumnoSeeder::class,
            NivelSeeder::class,
            GradoSeeder::class,
            SeccionSeeder::class,
            AreaSeeder::class,
            CursoSeeder::class,
            //MatriculaSeeder::class,
        ]);
    }
}
