<?php

namespace App\Http\Controllers\Controladores;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Matricula;
use App\Models\Alumno;
use App\Models\Periodo;
use App\Models\Seccion;
use App\Models\MatriculaCurso;
use Illuminate\Support\Facades\Log;
use App\Models\Curso;

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
            $secciones = Seccion::all();
            
            return view('matriculas.create', compact('alumnos', 'periodos', 'secciones'));
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
        try {
            $data = $request->validate([
                'id_alumno' => 'required|exists:alumnos,id_alumno',
                'id_periodo' => 'required|exists:periodos,id_periodo',
                'id_seccion' => 'required|exists:secciones,id_seccion',
                'estado' => 'required|in:activo,inactivo'
            ], [
                'id_alumno.required' => 'El alumno es requerido',
                'id_alumno.exists' => 'El alumno seleccionado no existe',
                'id_periodo.required' => 'El período es requerido',
                'id_periodo.exists' => 'El período seleccionado no existe',
                'id_seccion.required' => 'La sección es requerida',
                'id_seccion.exists' => 'La sección seleccionada no existe',
                'estado.required' => 'El estado es requerido',
                'estado.in' => 'El estado debe ser activo o inactivo'
            ]);

            // Verificar si ya existe una matrícula para el alumno en el periodo
            $matriculaExistente = Matricula::where('id_alumno', $data['id_alumno'])
                ->where('id_periodo', $data['id_periodo'])
                ->first();

            if ($matriculaExistente) {
                return redirect()->back()
                    ->withErrors(['error' => 'El alumno ya está matriculado en este período'])
                    ->withInput();
            }

            Matricula::create($data);
            return redirect()->route('matriculas.index')
                ->with('success', 'Matrícula creada exitosamente');

        } catch (\Exception $e) {
            Log::error('Error al crear matrícula:', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);
            return redirect()->back()
                ->withErrors(['error' => 'Error al crear la matrícula'])
                ->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $matricula = Matricula::findOrFail($id);
            $alumnos = Alumno::all();
            $periodos = Periodo::all();
            $secciones = Seccion::all();
            
            return view('matriculas.edit', compact('matricula', 'alumnos', 'periodos', 'secciones'));
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
            $data = $request->validate([
                'id_alumno' => 'required|exists:alumnos,id_alumno',
                'id_periodo' => 'required|exists:periodos,id_periodo',
                'id_seccion' => 'required|exists:secciones,id_seccion',
                'estado' => 'required|in:activo,inactivo'
            ]);

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
            $matricula->delete();
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
            $cursos = Curso::all();
            return view('matriculas.show', compact('matricula', 'cursos'));
        } catch (\Exception $e) {
            Log::error('Error al mostrar matrícula:', [
                'error' => $e->getMessage(),
                'id' => $id
            ]);
            return redirect()->route('matriculas.index')
                ->withErrors(['error' => 'No se pudo encontrar la matrícula solicitada']);
        }
    }

    public function addCurso(Request $request, $id_matricula)
    {
        try {
            $request->validate([
                'id_curso' => 'required|exists:cursos,id_curso',
            ]);

            $matriculaCurso = new MatriculaCurso();
            $matriculaCurso->id_curso = $request->id_curso;
            $matriculaCurso->id_matricula = $id_matricula;
            $matriculaCurso->save();

            return redirect()->route('matriculas.show', $id_matricula)
                ->with('success', 'Curso agregado exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al agregar curso a matrícula:', [
                'error' => $e->getMessage(),
                'id_matricula' => $id_matricula,
                'data' => $request->all()
            ]);
            return redirect()->back()
                ->withErrors(['error' => 'Error al agregar el curso'])
                ->withInput();
        }
    }
} 