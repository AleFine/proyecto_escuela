<?php

namespace App\Http\Controllers\Controladores;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Periodo;
use Illuminate\Support\Facades\Log;

class PeriodoController extends Controller
{
    const PAGINATION = 10;

    public function index()
    {
        try {
            $periodos = Periodo::orderBy('fecha_inicio', 'desc')
                ->paginate(self::PAGINATION);
            return view('periodos.index', compact('periodos'));
        } catch (\Exception $e) {
            Log::error('Error al cargar periodos:', [
                'error' => $e->getMessage()
            ]);
            return redirect()->back()
                ->withErrors(['error' => 'Error al cargar la lista de períodos']);
        }
    }

    public function create()
    {
        try {
            return view('periodos.create');
        } catch (\Exception $e) {
            Log::error('Error en create de periodos:', [
                'error' => $e->getMessage()
            ]);
            return redirect()->route('periodos.index')
                ->withErrors(['error' => 'Error al cargar el formulario de creación']);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'nombre_periodo' => 'required|string|max:50',
                'fecha_inicio' => 'required|date|date_format:Y-m-d',
                'fecha_fin' => 'required|date|date_format:Y-m-d|after:fecha_inicio',
                'estado' => 'required|string|in:activo,inactivo'
            ], [
                'nombre_periodo.required' => 'El nombre del período es requerido',
                'nombre_periodo.string' => 'El nombre debe ser texto',
                'fecha_inicio.required' => 'La fecha de inicio es requerida',
                'fecha_inicio.date_format' => 'El formato de fecha de inicio debe ser YYYY-MM-DD',
                'fecha_fin.required' => 'La fecha de fin es requerida',
                'fecha_fin.date_format' => 'El formato de fecha de fin debe ser YYYY-MM-DD',
                'fecha_fin.after' => 'La fecha de fin debe ser posterior a la fecha de inicio',
                'estado.required' => 'El estado es requerido',
                'estado.in' => 'El estado debe ser activo o inactivo'
            ]);

            $periodoExistente = Periodo::where(function($query) use ($data) {
                $query->whereBetween('fecha_inicio', [$data['fecha_inicio'], $data['fecha_fin']])
                      ->orWhereBetween('fecha_fin', [$data['fecha_inicio'], $data['fecha_fin']]);
            })->first();

            if ($periodoExistente) {
                return redirect()->back()
                    ->withErrors(['error' => 'Ya existe un período que se superpone con las fechas indicadas'])
                    ->withInput();
            }

            Periodo::create($data);
            return redirect()->route('periodos.index')
                ->with('success', 'Período creado exitosamente');

        } catch (\Exception $e) {
            Log::error('Error al crear periodo:', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);
            return redirect()->back()
                ->withErrors(['error' => 'Error al crear el período: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $periodo = Periodo::findOrFail($id);
            return view('periodos.edit', compact('periodo'));
        } catch (\Exception $e) {
            Log::error('Error al editar periodo:', [
                'error' => $e->getMessage(),
                'id' => $id
            ]);
            return redirect()->route('periodos.index')
                ->withErrors(['error' => 'No se encontró el período especificado']);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $periodo = Periodo::findOrFail($id);
            $data = $request->validate([
                'nombre_periodo' => 'required|max:50',
                'fecha_inicio' => 'required|date',
                'fecha_fin' => 'required|date|after:fecha_inicio',
                'estado' => 'required|in:activo,inactivo'
            ], [
                'nombre_periodo.required' => 'El nombre del período es requerido',
                'fecha_inicio.required' => 'La fecha de inicio es requerida',
                'fecha_fin.required' => 'La fecha de fin es requerida',
                'fecha_fin.after' => 'La fecha de fin debe ser posterior a la fecha de inicio',
                'estado.required' => 'El estado es requerido'
            ]);

            $periodo->update($data);
            return redirect()->route('periodos.index')
                ->with('success', 'Período actualizado exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al actualizar periodo:', [
                'error' => $e->getMessage(),
                'id' => $id,
                'data' => $request->all()
            ]);
            return redirect()->back()
                ->withErrors(['error' => 'Error al actualizar el período'])
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $periodo = Periodo::findOrFail($id);
            $periodo->delete();
            return redirect()->route('periodos.index')
                ->with('success', 'Período eliminado exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al eliminar periodo:', [
                'error' => $e->getMessage(),
                'id' => $id
            ]);
            return redirect()->back()
                ->withErrors(['error' => 'Error al eliminar el período']);
        }
    }

    public function show($id)
    {
        try {
            $periodo = Periodo::findOrFail($id);
            return view('periodos.show', compact('periodo'));
        } catch (\Exception $e) {
            Log::error('Error al mostrar periodo:', [
                'error' => $e->getMessage(),
                'id' => $id
            ]);
            return redirect()->route('periodos.index')
                ->withErrors(['error' => 'No se pudo encontrar el período solicitado']);
        }
    }
}
