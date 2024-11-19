<?php

namespace App\Http\Controllers\Controladores;
use App\Http\Controllers\Controller;

use App\Models\Seccion;
use App\Models\Grado;
use App\Models\Matricula;
use Illuminate\Http\Request;

class SeccionController extends Controller
{
    public function index(Request $request)
    {
        $query = Seccion::query();

        if ($request->has('grado')) {
            $grado = $request->input('grado');
            $query->whereHas('grado', function($q) use ($grado) {
                $q->where('nombre_grado', 'like', '%' . $grado . '%');
            });
        }

        $secciones = $query->with('grado.nivel')->get();
        return view('NGS.secciones.index', compact('secciones'));
    }

    public function create()
    {
        $grados = Grado::all();
        return view('NGS.secciones.create', compact('grados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_seccion' => ['required', 'regex:/^[A-Z]$/'],
            'aforo' => 'required|integer|min:1',
            'id_grado' => 'required|exists:grados,id_grado',
        ]);

        Seccion::create($request->all());

        return redirect()->route('secciones.index')
                        ->with('success', 'Sección creada correctamente.');
    }

    public function show($id_seccion)
    {
        $seccion = Seccion::with(['matriculas.alumno', 'grado.nivel'])->findOrFail($id_seccion);
        $estudiantesSeccion = $seccion->matriculas;
        $numEstudiantes = $estudiantesSeccion->pluck('alumno.id_alumno')->unique()->count();
        return view('NGS.secciones.show', compact('seccion', 'estudiantesSeccion', 'numEstudiantes'));
    }

    public function edit($id_seccion)
    {
        $seccion = Seccion::findOrFail($id_seccion);
        $grados = Grado::all();
        return view('NGS.secciones.edit', compact('seccion', 'grados'));
    }

    public function update(Request $request, $id_seccion)
    {
        $request->validate([
            'nombre_seccion' => ['required', 'regex:/^[A-Z]$/'],
            'aforo' => 'required|integer|min:1',
            'id_grado' => 'required|exists:grados,id_grado',
        ]);

        $seccion = Seccion::findOrFail($id_seccion);
        
        // Verificar que el nuevo aforo no sea menor que el número actual de estudiantes
        $estudiantesActuales = $seccion->matriculas()->count();
        if ($request->aforo < $estudiantesActuales) {
            return back()->withErrors(['aforo' => 'El aforo no puede ser menor que el número actual de estudiantes']);
        }

        $seccion->update($request->all());

        return redirect()->route('secciones.index')
                        ->with('success', 'Sección actualizada correctamente.');
    }


    public function destroy($id_seccion)
    {
        $seccion = Seccion::findOrFail($id_seccion);
        
        // Verificar si hay matrículas asociadas
        if ($seccion->matriculas()->exists()) {
            return back()->withErrors(['error' => 'No se puede eliminar la sección porque tiene estudiantes matriculados']);
        }
        
        $seccion->delete();

        return redirect()->route('secciones.index')
                        ->with('success', 'Sección eliminada correctamente.');
    }

    public function getSeccionesByGrado($id_grado)
    {
        $secciones = Seccion::where('id_grado', $id_grado)
                           ->withCount('matriculas')
                           ->get();
        return response()->json($secciones);
    }
}
