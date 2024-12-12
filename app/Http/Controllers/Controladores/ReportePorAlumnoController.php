<?php

namespace App\Http\Controllers\Controladores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grado;
use App\Models\Seccion;
use App\Models\Matricula;
use App\Models\Calificacion;
use App\Models\Alumno;
use App\Models\Nivel;
use App\Models\Curso;

class ReportePorAlumnoController extends Controller
{
    public function index(){
        $niveles = Nivel::all();
        return view('generar_reporte.index', compact('niveles'));
    }

    public function show(Request $request){

        function letraANumero($letra) {
            switch ($letra) {
                case 'AD': return 20;
                case 'A': return 16;
                case 'B': return 13;
                case 'C': return 10;
                default: return 0;
            }
        }

        $id_nivel = $request->input('nivel');
        $id_seccion = $request->input('seccion');
        $id_grado = $request->input('grado');
        $id_alumno = $request->input('alumno');
        $id_curso = $request->input('curso');

        $nivel = Nivel::findOrFail($id_nivel);
        $seccion = Seccion::findOrFail($id_seccion);
        $alumno = Alumno::findOrFail($id_alumno);
        $curso = Curso::findOrFail($id_curso);
        $grado = Grado::findOrFail($id_grado);

        $matricula = Matricula::where('id_alumno', $id_alumno)
            ->where('id_seccion', $id_seccion)
            ->first();
        $calificaciones_unidad1 = Calificacion::where('id_matricula',$matricula->id_matricula)->where('id_curso',$id_curso)->where('id_unidad',1)->orderBy('id_competencia', 'asc')->with('competencia')->get();
        $calificaciones_unidad2 = Calificacion::where('id_matricula',$matricula->id_matricula)->where('id_curso',$id_curso)->where('id_unidad',2)->orderBy('id_competencia', 'asc')->with('competencia')->get();
        $calificaciones_unidad3 = Calificacion::where('id_matricula',$matricula->id_matricula)->where('id_curso',$id_curso)->where('id_unidad',3)->orderBy('id_competencia', 'asc')->with('competencia')->get();

        foreach ($calificaciones_unidad1 as $calificacion) {
            $notas['unidad1'][] = letraANumero($calificacion->calificacion);
        }

        foreach ($calificaciones_unidad2 as $calificacion) {
            $notas['unidad2'][] = letraANumero($calificacion->calificacion);
        }

        foreach ($calificaciones_unidad3 as $calificacion) {
            $notas['unidad3'][] = letraANumero($calificacion->calificacion);
        }

        $dataForChart = [
            'labels' => array_keys($notas),
            'datasets' => [
                [
                    'label' => 'Competencia 1',
                    'data' => array_column($notas, 0),
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                ],
                [
                    'label' => 'Competencia 2',
                    'data' => array_column($notas, 1),
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                ],
                [
                    'label' => 'Competencia 3',
                    'data' => array_column($notas, 2),
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                ],
            ],
        ];

        return view('generar_reporte.show', compact('nivel', 'seccion', 'alumno', 'curso', 'grado', 'dataForChart'));
    }


    public function getGrados($nivelId){
        $grados = Grado::where('id_nivel',$nivelId)->get();
        return response()->json($grados);
    }

    public function getSecciones($gradoId){
        $secciones = Seccion::where('id_grado',$gradoId)->get();
        return response()->json($secciones);
    }

    public function getAlumnos($seccionId){
        $alumnos = Matricula::where('id_seccion', $seccionId)->with('alumno')
        ->get()->pluck('alumno');
        return response()->json($alumnos);
    }

    public function getCursos($alumnoId){
        $cursos = Matricula::where('id_alumno', $alumnoId)->first()->cursos;
        return response()->json($cursos);
    }

    function numeroALetra($numero) {
        if ($numero >= 18) {
            return 'AD';
        } elseif ($numero >= 14) {
            return 'A';
        } elseif ($numero >= 11) {
            return 'B';
        } elseif ($numero >= 6) {
            return 'C';
        } else {
            return 'D';
        }
    }
}
