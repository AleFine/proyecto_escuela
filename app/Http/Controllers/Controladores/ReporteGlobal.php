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
