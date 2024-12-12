<?php

namespace App\Http\Controllers\Roles;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PadreFamilia;
use App\Models\Alumno;
use App\Models\Matricula;
use App\Models\Curso;
use App\Models\Calificacion;
use Illuminate\Http\Request;

class PadreFamiliaController extends Controller
{
    public function index($gmail)
    {
        $id_padre = User::where("email",$gmail)->first()->id;
        $padre = PadreFamilia::where("id",$id_padre)->first();
        return view('padre_familia.dashboard',compact('padre'));
    }

    public function show($id)
{
    $estudiante = Alumno::where("id_alumno", $id)->first();
    $matricula = Matricula::where("id_alumno", $id)->first();

    if (!$matricula) {
        return redirect()->back()->with('error', 'No se encontró matrícula para este estudiante.');
    }

    $cursos = $matricula->cursos;

    return view('padre_familia.show', compact('cursos', 'estudiante'));
}


    public function verNotas($id_curso, $id_alumno) {
        $estudianteA = Alumno::findOrFail($id_alumno);
        $cursoA = Curso::findOrFail($id_curso);
    
        $matricula = $estudianteA->matriculas()->whereHas('cursos', function($q) use($id_curso) {
            $q->where('cursos.id_curso', $id_curso);
        })->firstOrFail();
    
        $calificaciones_unidad1 = Calificacion::where('id_matricula', $matricula->id_matricula)
            ->where('id_curso', $id_curso)
            ->where('id_unidad', 1)
            ->orderBy('id_competencia', 'asc')
            ->with('competencia')
            ->get();
    
        $calificaciones_unidad2 = Calificacion::where('id_matricula', $matricula->id_matricula)
            ->where('id_curso', $id_curso)
            ->where('id_unidad', 2)
            ->orderBy('id_competencia', 'asc')
            ->with('competencia')
            ->get();
    
        $calificaciones_unidad3 = Calificacion::where('id_matricula', $matricula->id_matricula)
            ->where('id_curso', $id_curso)
            ->where('id_unidad', 3)
            ->orderBy('id_competencia', 'asc')
            ->with('competencia')
            ->get();
    
        return view('padre_familia.calificaciones', compact(
            'cursoA', 'estudianteA', 'matricula', 
            'calificaciones_unidad1', 'calificaciones_unidad2', 'calificaciones_unidad3'
        ));
    }
    
}
