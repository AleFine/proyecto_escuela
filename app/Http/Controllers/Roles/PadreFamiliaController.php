<?php

namespace App\Http\Controllers\Roles;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PadreFamilia;
use App\Models\Alumno;
use App\Models\Matricula;
use App\Models\Curso;
use Illuminate\Http\Request;

class PadreFamiliaController extends Controller
{
    public function index($gmail)
    {
        $id_padre = User::where("email",$gmail)->first()->id;
        $padre = PadreFamilia::where("id",$id_padre)->first();
        $hijos = $padre->hijos;
        return view('padre_familia.dashboard',compact('padre','hijos'));
    }

    public function show($id)
    {
        $estudiante = Alumno::where("id_alumno",$id)->first();
        $matricula = Matricula::where("id_alumno",$id)->first();
        $cursos = $matricula->cursos;
        return view('padre_familia.show',compact('cursos','estudiante'));
    }
}
