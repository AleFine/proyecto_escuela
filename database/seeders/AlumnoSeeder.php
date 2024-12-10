<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class AlumnoSeeder extends Seeder
{

    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('alumnos')->truncate();

        $alumnos = [
            ['nombre' => 'Ana', 'apellido' => 'García', 'dni' => '12345678', 'fecha_nacimiento' => Carbon::create(2005, 5, 15), 'genero' => 'Femenino', 'region' => 'Lima', 'ciudad' => 'Lima', 'distrito' => 'Miraflores', 'telefono' => '987654321', 'imagen_rostro' => null],
            ['nombre' => 'María', 'apellido' => 'Pérez', 'dni' => '87654321', 'fecha_nacimiento' => Carbon::create(2006, 3, 20), 'genero' => 'Femenino', 'region' => 'Arequipa', 'ciudad' => 'Arequipa', 'distrito' => 'Cercado', 'telefono' => '912345678', 'imagen_rostro' => null],
            ['nombre' => 'José', 'apellido' => 'Rodríguez', 'dni' => '23456789', 'fecha_nacimiento' => Carbon::create(2005, 7, 10), 'genero' => 'Masculino', 'region' => 'Lima', 'ciudad' => 'San Isidro', 'distrito' => 'San Isidro', 'telefono' => '987654322', 'imagen_rostro' => null],
            ['nombre' => 'Lucía', 'apellido' => 'Martínez', 'dni' => '34567890', 'fecha_nacimiento' => Carbon::create(2006, 1, 25), 'genero' => 'Femenino', 'region' => 'Cusco',  'ciudad' => 'Cuzco','distrito'=>'Santa Ana','telefono'=>'912345679','imagen_rostro'=>null],
            ['nombre'=>'Diego','apellido'=>'Hernández','dni'=>'45678901','fecha_nacimiento'=>Carbon::create(2005, 11, 30),'genero'=>'Masculino','region'=>'Lima','ciudad'=>'Callao','distrito'=>'Callao','telefono'=>'987654323','imagen_rostro'=>null],
            ['nombre'=>'Sofía','apellido'=>'López','dni'=>'56789012','fecha_nacimiento'=>Carbon::create(2006, 4, 12),'genero'=>'Femenino','region'=>'Piura','ciudad'=>'Piura','distrito'=>'Piura','telefono'=>'912345680','imagen_rostro'=>null],
            ['nombre'=>'Juan','apellido'=>'Sánchez','dni'=>'67890123','fecha_nacimiento'=>Carbon::create(2005, 9, 5),'genero'=>'Masculino','region'=>'Tacna','ciudad'=>'Tacna','distrito'=>'Tacna','telefono'=>'987654324','imagen_rostro'=>null],
            ['nombre'=>'Valentina','apellido'=>'González','dni'=>'78901234','fecha_nacimiento'=>Carbon::create(2006, 12, 15),'genero'=>'Femenino','region'=>'Junín','ciudad'=>'Huancayo','distrito'=>'Huancayo','telefono'=>'912345681','imagen_rostro'=>null],
            ['nombre'=>'Andrés','apellido'=>'Ramírez','dni'=>'89012345','fecha_nacimiento'=>Carbon::create(2005, 2, 18),'genero'=>'Masculino','region'=>'Lambayeque','ciudad'=>'Chiclayo','distrito'=>'Chiclayo','telefono'=>'987654325','imagen_rostro'=>null],
            ['nombre'=>'Camila','apellido'=>'Torres','dni'=>'90123456','fecha_nacimiento'=>Carbon::create(2006, 8, 22),'genero'=>'Femenino','region'=>'La Libertad','ciudad'=>'Trujillo','distrito'=>'Trujillo','telefono'=>'912345682','imagen_rostro'=>null],
            ['nombre'=>'Felipe','apellido'=>'Vásquez','dni'=>'51234567','fecha_nacimiento'=>Carbon::create(2005, 10, 27),'genero'=>'Masculino','region'=>'Arequipa','ciudad'=>'Arequipa ','distrito'=> 'Cercado de Arequipa ','telefono'=> '987654326 ','imagen_rostro'=>null],
        ];

        DB::table('alumnos')->insert($alumnos);
    }
}
