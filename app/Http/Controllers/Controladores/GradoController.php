<?php

namespace App\Http\Controllers\Controladores;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Grado;
use App\Models\Nivel; // Importa el modelo Nivel si aún no está importado

class GradoController extends Controller
{
    public function index()
    {
        $grados = Grado::all();
        return view('NGS.grados.index', compact('grados'));
    }


    public function create()
    {
        $niveles = Nivel::all(); //Obtiene los niveles para el formulario
        return view('NGS.grados.create', compact('niveles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_grado' => 'required|string|max:255',
            'id_nivel' => 'required|exists:niveles,id_nivel',
        ]);

        Grado::create($request->all());

        return redirect()->route('grados.index')
                        ->with('success', 'Grado creado correctamente.');
    }

    public function show(Grado $grado)
    {
        return view('NGS.grados.show', compact('grado'));
    }

    public function edit(Grado $grado)
    {
        $niveles = Nivel::all(); // Obtener todos los niveles para el formulario
        return view('NGS.grados.edit', compact('grado', 'niveles'));
    }

    public function update(Request $request, Grado $grado)
    {
        $request->validate([
            'nombre_grado' => 'required|string|max:255',
            'id_nivel' => 'required|exists:niveles,id_nivel',
        ]);

        $grado->update($request->all());

        return redirect()->route('grados.index')
                        ->with('success', 'Grado actualizado correctamente.');
    }

    public function destroy(Grado $grado)
    {
        $grado->delete();

        return redirect()->route('grados.index')
                        ->with('success', 'Grado eliminado correctamente.');
    }
}
