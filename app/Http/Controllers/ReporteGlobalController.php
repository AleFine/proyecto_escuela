<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grado;
use App\Models\Seccion;
use App\Models\Matricula;
use App\Models\Calificacion;
use App\Models\Alumno;
use App\Models\Nivel;
use App\Models\Curso;


class ReporteGlobalController extends Controller
{
    public function index(){
        $niveles = Nivel::all();
        return view('reporte_global.index', compact('niveles'));
    }

    public function show(Request $request)
{
    $idNivel = $request->input('nivel');
    $idGrado = $request->input('grado');
    $idSeccion = $request->input('seccion');

    $grado = Grado::findOrFail($idGrado);
    $nivel = Nivel::findOrFail($idNivel);
    $seccion = Seccion::findOrFail($idSeccion);

    // Calcular métricas principales
    $promedioGeneral = Calificacion::whereHas('matricula', function ($query) use ($idSeccion) {
        $query->where('id_seccion', $idSeccion);
    })->avg('calificacion');

    $mejorRendimiento = Calificacion::whereHas('matricula', function ($query) use ($idSeccion) {
        $query->where('id_seccion', $idSeccion);
    })->where('calificacion', '>=', 18)->count();

    $riesgoAcademico = Calificacion::whereHas('matricula', function ($query) use ($idSeccion) {
        $query->where('id_seccion', $idSeccion);
    })->where('calificacion', '<=', 10)->count();

    // Datos para el gráfico
    $cursos = Curso::where('id_grado', $idGrado)->pluck('nombre_curso');
    $promediosPorCurso = 20;

    return view('reporte_global.vista_reporte', compact(
        'grado',
        'nivel',
        'seccion',
        'promedioGeneral',
        'mejorRendimiento',
        'riesgoAcademico',
        'cursos',
        'promediosPorCurso'
    ));
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
}
