<?php

namespace App\Http\Controllers\Roles;
use App\Http\Controllers\Controller;
use App\Models\Profesor;
use App\Models\DocenteAsignado;
use App\Models\Seccion;
use App\Models\Calificacion;
use App\Models\Curso;
use App\Models\Alumno;
use App\Models\User;
use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    public function index($gmail)
    {
        $id_profesor = User::where("email",$gmail)->first()->id;
        $profesor = Profesor::where("user_id",$id_profesor)->first();
        $docente_seccion = DocenteAsignado::where("id_profesor",$profesor->id_profesor)->get();
        $cantidad = $docente_seccion->count();

        if($cantidad == 0){
            return view('profesor.secundaria', compact('profesor','docente_seccion'));
        }
        else{
            $nivel = $docente_seccion[0]->seccion->grado->id_nivel;

            if($cantidad == 1 && $nivel == 1){
                $seccion = $docente_seccion[0]->seccion;
                $cursos = $docente_seccion[0]->cursos;
                return view('profesor.primaria', compact('profesor','seccion','cursos'));
            }
            else{
                return view('profesor.secundaria', compact('profesor','docente_seccion'));
            }
        }
    }

    public function show(Request $request){
        $id_curso = $request->input('curso');
        $id_profesor = $request->input('profesor');

        $profesor = Profesor::findOrFail($id_profesor);
        $curso = Curso::findOrFail($id_curso);
        $matriculas = $curso->matricula;

        if($request->input('seccion')){
            $id_seccion = $request->input('seccion');
            $seccion = Seccion::findOrFail($id_seccion);
        }
        else{
            $id_docente_asignado = $request->input('docente');
            $seccion = DocenteAsignado::findOrFail($id_docente_asignado)->seccion;
        }
        return view('profesor.show',compact('matriculas','seccion','curso','profesor'));
    }

    public function asignar_calificacion($curso,$estudiante){
        $estudianteA = Alumno::findOrFail($estudiante);
        $cursoA = Curso::findOrFail($curso);

        $calificaciones_unidad1 = Calificacion::where('id_curso',$curso)->where('id_unidad',1)->orderBy('id_competencia', 'asc')->get();

        $calificaciones_unidad2 = Calificacion::where('id_curso',$curso)->where('id_unidad',2)->orderBy('id_competencia', 'asc')->get();

        $calificaciones_unidad3 = Calificacion::where('id_curso',$curso)->where('id_unidad',3)->orderBy('id_competencia', 'asc')->get();

        return view('profesor.calificaciones', compact('calificaciones_unidad1','calificaciones_unidad2','calificaciones_unidad3'));
    }

    public function calificar_curso(Request $request){
        $curso  = $request->input('curso');
        
    }
}
