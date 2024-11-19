<?php

namespace App\Http\Controllers\Controladores;
use App\Http\Controllers\Controller;

use App\Models\AreaAcademica;
use Illuminate\Http\Request;

class AreaAcademicaController extends Controller
{
    const PAGINATION = 5;

    public function index(Request $request)
    {
        $buscarpor = $request->get('buscarpor');
        $areas = AreaAcademica::where('nombre_area', 'like', '%' . $buscarpor . '%')
            ->paginate($this::PAGINATION);
        return view('areas.index', compact('areas', 'buscarpor'));
    }

    public function create()
    {
        return view('areas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre_area' => 'required|max:50'
        ], [
            'nombre_area.required' => 'Ingrese el nombre del área académica',
            'nombre_area.max' => 'Máximo 50 caracteres para el nombre del área'
        ]);

        $area = new AreaAcademica();
        $area->fill($data);
        $area->save();

        return redirect()->route('areas.index')->with('datos', 'Área académica creada correctamente');
    }

    public function edit($id)
    {
        $area = AreaAcademica::findOrFail($id);
        return view('areas.edit', compact('area'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nombre_area' => 'required|max:50'
        ], [
            'nombre_area.required' => 'Ingrese el nombre del área académica',
            'nombre_area.max' => 'Máximo 50 caracteres para el nombre del área'
        ]);

        $area = AreaAcademica::findOrFail($id);
        $area->fill($data);
        $area->save();

        return redirect()->route('areas.index')->with('datos', 'Área académica actualizada correctamente');
    }

    public function confirmar($id)
    {
        $area = AreaAcademica::findOrFail($id);
        return view('areas.confirmar', compact('area'));
    }

    public function destroy($id)
    {
        $area = AreaAcademica::findOrFail($id);

        if($area->cursos()->exists() || $area->profesores()->exists()) {
            return back()->withErrors(['error' => 'No se puede eliminar el área porque tiene cursos o profesores asociados']);
        }

        $area->delete();

        return redirect()->route('areas.index')->with('datos', 'Área académica eliminada correctamente');
    }
}
