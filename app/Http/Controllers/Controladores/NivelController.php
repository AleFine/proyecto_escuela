<?php

namespace App\Http\Controllers\Controladores;
use App\Http\Controllers\Controller;

use App\Models\Nivel;
use Illuminate\Http\Request;

class NivelController extends Controller
{
    public function index()
    {
        $nivels = Nivel::all();
        return view('NGS.niveles.index', compact('nivels'));
    }


    public function create()
    {
        return view('NGS.niveles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'turno' => 'required|string|max:255',
            'nombre_nivel' => 'required|string|max:255',
        ]);

        Nivel::create($request->all());

        return redirect()->route('nivels.index')->with('success', 'Nivel creado exitosamente.');
    }

    public function show(Nivel $nivel)
    {
        return view('NGS.niveles.show', compact('nivel'));
    }

    public function edit(Nivel $nivel)
    {
        return view('NGS.niveles.edit', compact('nivel'));
    }

    public function update(Request $request, Nivel $nivel)
    {
        $request->validate([
            'turno' => 'required|string|max:255',
            'nombre_nivel' => 'required|string|max:255',
        ]);

        $nivel->update($request->all());

        return redirect()->route('nivels.index')->with('success', 'Nivel actualizado exitosamente.');
    }

    public function destroy(Nivel $nivel)
    {
        $nivel->delete();

        return redirect()->route('nivels.index')->with('success', 'Nivel eliminado exitosamente.');
    }
}
