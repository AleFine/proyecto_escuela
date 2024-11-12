<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;
use App\Models\Ciudad;
use App\Models\Distrito;
use Illuminate\Support\Facades\File;

class RegionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $departmentsData = File::get(database_path('seeders/json/departments.json'));
        $departments = json_decode($departmentsData, true);

        foreach ($departments as $department) {
            // Crear o encontrar la región (departamento)
            $region = Region::firstOrCreate([
                'nombre' => $department['name'],
            ]);

            // Leer y cargar el JSON de provincias
            $provincesData = File::get(database_path('seeders/json/provinces.json'));
            $provinces = json_decode($provincesData, true);

            foreach ($provinces as $province) {
                // Verificar que la provincia corresponda al departamento actual
                if ($province['department_id'] === $department['id']) {
                    // Crear o encontrar la ciudad (provincia)
                    $ciudad = Ciudad::firstOrCreate([
                        'nombre' => $province['name'],
                        'region_id' => $region->id
                    ]);

                    // Leer y cargar el JSON de distritos
                    $districtsData = File::get(database_path('seeders/json/districts.json'));
                    $districts = json_decode($districtsData, true);

                    foreach ($districts as $district) {
                        // Verificar que el distrito corresponda a la provincia actual
                        if ($district['province_id'] === $province['id']) {
                            // Crear o encontrar el distrito
                            Distrito::firstOrCreate([
                                'nombre' => $district['name'],
                                'ciudad_id' => $ciudad->id
                            ]);
                        }
                    }
                }
            }
        }
    }
}
