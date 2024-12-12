<?php

namespace App\Http\Controllers\Controladores;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Models\Alumno;
use App\Models\Matricula;
use App\Models\Curso;
use App\Models\Calificacion;

class ReporteController extends Controller
{
    public function generarReporteNotas($id_alumno)
    {
        $alumno = Alumno::findOrFail($id_alumno);

        $matricula = Matricula::where('id_alumno', $id_alumno)->where('estado', 'activo')->firstOrFail();
        
        $cursos = DB::table('matricula_cursos')
            ->join('cursos', 'matricula_cursos.id_curso', '=', 'cursos.id_curso')
            ->where('matricula_cursos.id_matricula', $matricula->id_matricula)
            ->select('cursos.id_curso', 'cursos.nombre_curso')
            ->get();

        $dataCursos = [];

        foreach ($cursos as $curso) {
            $calificaciones = Calificacion::where('id_matricula', $matricula->id_matricula)
                ->where('id_curso', $curso->id_curso)
                ->with('competencia') 
                ->orderBy('id_unidad', 'asc')
                ->orderBy('id_competencia', 'asc')
                ->get();


            $comp1 = $calificaciones->get(0)->competencia->nombre_competencia ?? 'C1';
            $comp2 = $calificaciones->get(1)->competencia->nombre_competencia ?? 'C2';
            $comp3 = $calificaciones->get(2)->competencia->nombre_competencia ?? 'C3';

            $dataCursos[] = [
                'id_curso' => $curso->id_curso,
                'nombre_curso' => $curso->nombre_curso,
                'competencias' => [
                    [
                        'nombre' => $comp1,
                        'u1' => $calificaciones->get(0)->calificacion ?? '',
                        'u2' => $calificaciones->get(3)->calificacion ?? '',
                        'u3' => $calificaciones->get(6)->calificacion ?? '',
                    ],
                    [
                        'nombre' => $comp2,
                        'u1' => $calificaciones->get(1)->calificacion ?? '',
                        'u2' => $calificaciones->get(4)->calificacion ?? '',
                        'u3' => $calificaciones->get(7)->calificacion ?? '',
                    ],
                    [
                        'nombre' => $comp3,
                        'u1' => $calificaciones->get(2)->calificacion ?? '',
                        'u2' => $calificaciones->get(5)->calificacion ?? '',
                        'u3' => $calificaciones->get(8)->calificacion ?? '',
                    ],
                ]
            ];
        }

        $pdf = Pdf::loadView('reports.reporte_notas', [
            'alumno' => $alumno,
            'matricula' => $matricula,
            'dataCursos' => $dataCursos
        ]);

        return $pdf->stream('reporte_notas_'.$alumno->id_alumno.'.pdf');

    }
}
