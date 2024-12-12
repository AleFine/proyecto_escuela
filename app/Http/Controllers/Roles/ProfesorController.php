<?php

namespace App\Http\Controllers\Roles;
use App\Http\Controllers\Controller;
use App\Models\Profesor;
use App\Models\DocenteAsignado;
use App\Models\Seccion;
use App\Models\Calificacion;
use App\Models\Matricula;
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

        $matricula = Matricula::where('id_alumno',$estudiante)->first();

        $estudianteA = Alumno::findOrFail($estudiante);
        $cursoA = Curso::findOrFail($curso);

        $calificaciones_unidad1 = Calificacion::where('id_matricula',$matricula->id_matricula)->where('id_curso',$curso)->where('id_unidad',1)->orderBy('id_competencia', 'asc')->with('competencia')->get();
        $calificaciones_unidad2 = Calificacion::where('id_matricula',$matricula->id_matricula)->where('id_curso',$curso)->where('id_unidad',2)->orderBy('id_competencia', 'asc')->with('competencia')->get();
        $calificaciones_unidad3 = Calificacion::where('id_matricula',$matricula->id_matricula)->where('id_curso',$curso)->where('id_unidad',3)->orderBy('id_competencia', 'asc')->with('competencia')->get();

        return view('profesor.calificaciones', compact('calificaciones_unidad1','calificaciones_unidad2','calificaciones_unidad3','matricula','estudianteA','cursoA'));
    }

    public function calificar_curso(Request $request){

        $curso = $request->input('curso');
        $estudiante = $request->input('estudiante');

        for($i=1;$i<=9;$i++){
            $name = "nota".$i;
            $nota = $request->input($name);
            if($nota != 'A' && $nota != 'B' && $nota != 'C' && $nota != 'AD'){
                $nota = 'D';
            }
            $notas[$i] = $nota;
        }

        for($j=1;$j<=9;$j++){
            $name1 = "id_nota".$j;
            $identificadores[$j] = $request->input($name1);
        }

        for($i=1;$i<=9;$i++){
            $calificacion = Calificacion::findOrFail($identificadores[$i]);
            $calificacion->calificacion = $notas[$i];
            $calificacion->save();
        }

        return redirect()->route('profesor.asignar_calificacion',['curso'=>$curso,'estudiante'=>$estudiante])
                ->with('success', 'Se asigno correctamente las notas');

    }
}
