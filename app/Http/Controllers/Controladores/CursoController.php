<?php

namespace App\Http\Controllers\Controladores;
use App\Http\Controllers\Controller;
use App\Models\Nivel;
use App\Models\Grado;
use App\Models\Curso;
use App\Models\AreaAcademica;

use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index(int $nivel){
        $grados = Grado::where('id_nivel', $nivel)->with('cursos')->paginate(1);

        if ($nivel == 1){
            return view('cursos.primaria.index', compact('nivel', 'grados'));
        }
        else{
            return view('cursos.secundaria.index', compact('nivel','grados'));
        }
    }

    public function create(int $nivel){
        $departamentos = AreaAcademica::all();
        $grados = Grado::where('id_nivel',$nivel)->get();

        if ($nivel == 1){
            return view('cursos.primaria.create', compact('nivel','departamentos', 'grados'));
        }
        else{
            return view('cursos.secundaria.create', compact('nivel','departamentos', 'grados'));
        }
    }

    public function store(Request $request){
        $request->validate([
            'nombre_curso'=>'required|max:100',
            'grado'=>'required',
            'departamento'=>'required',
        ],[
            'nombre_curso'=>'Ingrese el nombre del curso, máximo 100 caracteres',
            'grado'=>'Seleccione un grado',
            'departamento'=>'Seleccione un departamento',
        ]);
        $curso = new Curso();
        $curso->nombre_curso = $request->nombre_curso;
        $curso->id_grado = $request->grado;
        $curso->id_area_academica = $request->departamento;
        $curso->save();
        return redirect()->route('cursos.index', $curso->grado->id_nivel)->with('success', 'Curso creado correctamente');
    }

    public function edit($id_curso){
        $curso = Curso::findOrFail($id_curso);
        $departamentos = AreaAcademica::all();

        $nivel = $curso->grado->id_nivel;

        $grados = Grado::where('id_nivel',$nivel)->get();

        if ($nivel == 1){
            return view('cursos.primaria.edit', compact('curso','nivel','departamentos', 'grados'));
        }
        else{
            return view('cursos.secundaria.edit', compact('curso','nivel','departamentos', 'grados'));
        }
    }

    public function update(Request $request,$id_curso){
        $request->validate([
            'nombre_curso'=>'required|max:100',
            'grado'=>'required',
            'departamento'=>'required',
        ],[
            'nombre_curso'=>'Ingrese el nombre del curso, máximo 100 caracteres',
            'grado'=>'Seleccione un grado',
            'departamento'=>'Seleccione un departamento',
        ]);

        $curso = Curso::findOrFail($id_curso);

        $curso->nombre_curso = $request->nombre_curso;
        $curso->id_grado = $request->grado;
        $curso->id_area_academica = $request->departamento;
        $curso->save();
        return redirect()->route('cursos.index', [$curso->grado->id_nivel])->with('success', 'Curso actualizado correctamente');
    }

    public function destroy($id){
        $curso = Curso::findOrFail($id);
        $curso->delete();
        return redirect()->route('cursos.index', ['nivel'=>$curso->grado->id_nivel])->with('success', 'Curso eliminado con éxito.');
    }

}
