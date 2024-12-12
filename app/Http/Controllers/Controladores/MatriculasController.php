<?php

namespace App\Http\Controllers\Controladores;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Matricula;
use App\Models\Alumno;
use App\Models\Periodo;
use App\Models\Seccion;
use App\Models\Grado;
use App\Models\Nivel;
use Illuminate\Support\Facades\Log;
use App\Models\Curso;
use Illuminate\Support\Facades\DB;

class MatriculasController extends Controller
{
    const PAGINATION = 10;

    public function index()
    {
        try {
            $matriculas = Matricula::with(['alumno', 'periodo', 'seccion'])
                ->orderBy('created_at', 'desc')
                ->paginate(self::PAGINATION);
            return view('matriculas.index', compact('matriculas'));
        } catch (\Exception $e) {
            Log::error('Error al cargar matrículas:', [
                'error' => $e->getMessage()
            ]);
            return redirect()->back()
                ->withErrors(['error' => 'Error al cargar la lista de matrículas']);
        }
    }

    public function create()
    {
        try {
            $alumnos = Alumno::all();
            $periodos = Periodo::get();
            $niveles = Nivel::all();
            return view('matriculas.create', compact('alumnos', 'periodos', 'niveles'));
        } catch (\Exception $e) {
            Log::error('Error en create de matrículas:', [
                'error' => $e->getMessage()
            ]);
            return redirect()->route('matriculas.index')
                ->withErrors(['error' => 'Error al cargar el formulario de matrícula']);
        }
    }

    public function store(Request $request)
{

    $data = $request->validate([
        'id_alumno' => 'required|exists:alumnos,id_alumno',
        'id_periodo' => 'required|exists:periodos,id_periodo',
        'id_seccion' => 'required|exists:secciones,id_seccion',
        'estado' => 'required|in:activo,inactivo'
    ]);

    $matriculaExistente = Matricula::where('id_alumno', $data['id_alumno'])
        ->where('id_periodo', $data['id_periodo'])
        ->where('id_seccion', $data['id_seccion'])
        ->first();

    if ($matriculaExistente) {
        return redirect()->back()
            ->withErrors(['error' => 'El alumno ya está matriculado en este período en la misma sección'])
            ->withInput();
    }

    $seccion = Seccion::findOrFail($data['id_seccion']);

    if ($seccion->aforo < 0) {
        return redirect()->back()
            ->withErrors(['error' => 'La sección ya está llena'])
            ->withInput();
    } else {
        $seccion->aforo -= 1;
        $seccion->save();
    }

    $id_matricula = DB::table('matriculas')->insertGetId([
        'id_alumno' => $data['id_alumno'],
        'id_seccion' => $data['id_seccion'],
        'id_periodo' => $data['id_periodo'],
        'estado'=> $data['estado'],
        'created_at' => null,
        'updated_at' => null,
    ]);

    $grado = Seccion::findOrFail($data['id_seccion'])->id_grado;
    $cursos_matricular = Curso::where('id_grado', $grado)->get();

    foreach ($cursos_matricular as $curso) {
        DB::table('matricula_cursos')->insert([
            'id_matricula' => $id_matricula,
            'id_curso' => $curso->id_curso,
            'created_at' => null,
            'updated_at' => null,
        ]);
    }

    foreach ($cursos_matricular as $curso) {
        for($i=1; $i<4 ; $i++){
            for($j=1; $j<4 ; $j++){
                DB::table('calificaciones')->insert([
                    'id_matricula' => $id_matricula,
                    'calificacion' => 'D',
                    'id_curso' => $curso->id_curso,
                    'id_competencia' => $j,
                    'id_unidad' => $i,
                    'created_at' => null,
                    'updated_at' => null,
                ]);
            }
        }
    }

    return redirect()->route('matriculas.index')->with('success', 'Matrícula creada exitosamente');

}

    public function edit($id)
    {
        try {
            $matricula = Matricula::findOrFail($id);
            $alumnos = Alumno::all();
            $periodos = Periodo::all();
            $niveles = Nivel::all();

            return view('matriculas.edit', compact('matricula', 'alumnos', 'periodos', 'niveles'));
        } catch (\Exception $e) {
            Log::error('Error al editar matrícula:', [
                'error' => $e->getMessage(),
                'id' => $id
            ]);
            return redirect()->route('matriculas.index')
                ->withErrors(['error' => 'No se encontró la matrícula especificada']);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $matricula = Matricula::findOrFail($id);
            $grado_viejo = $matricula->seccion->id_grado;

            $data = $request->validate([
                'id_alumno' => 'required|exists:alumnos,id_alumno',
                'id_periodo' => 'required|exists:periodos,id_periodo',
                'id_seccion' => 'required|exists:secciones,id_seccion',
                'estado' => 'required|in:activo,inactivo'
            ]);

            $grado = $request->input('grado');

            if($grado != $grado_viejo){
                $cursos_matricular = Curso::where('id_grado', $grado)->get();
                DB::table('matricula_cursos')->where('id_matricula', $id)->delete();
                DB::table('calificaciones')->where('id_matricula', $id)->delete();
                foreach ($cursos_matricular as $curso) {
                    DB::table('matricula_cursos')->insert([
                        'id_matricula' => $id,
                        'id_curso' => $curso->id_curso,
                        'created_at' => null,
                        'updated_at' => null,
                    ]);
                }

                foreach ($cursos_matricular as $curso) {
                    for($i=0; $i<3 ; $i++){
                        for($j=0; $j<3 ; $j++){
                            DB::table('calificaciones')->insert([
                                'id_matricula' => $id,
                                'calificacion' => 'D',
                                'id_curso' => $curso->id_curso,
                                'id_competencia' => $j,
                                'id_unidad' => $i,
                                'created_at' => null,
                                'updated_at' => null,
                            ]);
                        }
                    }
                }

            }
            $matricula->update($data);
            return redirect()->route('matriculas.index')
                ->with('success', 'Matrícula actualizada exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al actualizar matrícula:', [
                'error' => $e->getMessage(),
                'id' => $id,
                'data' => $request->all()
            ]);
            return redirect()->back()
                ->withErrors(['error' => 'Error al actualizar la matrícula'])
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $matricula = Matricula::findOrFail($id);

            DB::table('matricula_cursos')->where('id_matricula', $id)->delete();
            DB::table('calificaciones')->where('id_matricula', $id)->delete();
            DB::table('matricula_cursos')->where('id_matricula', $id)->delete();

            $matricula->delete();

            $seccion = Seccion::findOrFail($matricula->id_seccion);

            $seccion->aforo += 1;
            $seccion->save();

            return redirect()->route('matriculas.index')
                ->with('success', 'Matrícula eliminada exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al eliminar matrícula:', [
                'error' => $e->getMessage(),
                'id' => $id
            ]);
            return redirect()->back()
                ->withErrors(['error' => 'Error al eliminar la matrícula']);
        }
    }

    public function show($id)
    {
        try {
            $matricula = Matricula::with(['alumno', 'periodo', 'seccion', 'cursos'])->findOrFail($id);
            return view('matriculas.show', compact('matricula'));
        } catch (\Exception $e) {
            Log::error('Error al mostrar matrícula:', [
                'error' => $e->getMessage(),
                'id' => $id
            ]);
            return redirect()->route('matriculas.index')
                ->withErrors(['error' => 'No se pudo encontrar la matrícula solicitada']);
        }
    }

    public function getGrados($nivelId){
        $grados = Grado::where('id_nivel',$nivelId)->get();
        return response()->json($grados);
    }

    public function getSecciones($gradoId){
        $secciones = Seccion::where('id_grado',$gradoId)->get();
        return response()->json($secciones);
    }
}
