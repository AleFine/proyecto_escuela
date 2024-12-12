@extends('layout.layout')

@section('contenido')

<div class="container">
    <p class="text-center fs-2 p-2 my-2">Calificaciones del Estudiante</p>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h3 class="card-title">Curso: {{ $cursoA->nombre_curso }}</h3>
            <p><strong>Estudiante:</strong> {{ $estudianteA->nombre }} {{ $estudianteA->apellido }}</p>
        </div>
    </div>

    <div class="table-responsive mb-4">
        <table class="table table-striped table-hover text-center align-middle">
            <thead>
                <tr>
                    <th>Competencia / Unidad</th>
                    <th>Unidad 1</th>
                    <th>Unidad 2</th>
                    <th>Unidad 3</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>{{ $calificaciones_unidad1->get(0)->competencia->nombre_competencia ?? 'Competencia 1' }}</th>
                    <td>
                        <input type="text" class="form-control text-center" 
                            value="{{ $calificaciones_unidad1->get(0)->calificacion ?? '' }}" disabled>
                    </td>
                    <td>
                        <input type="text" class="form-control text-center"
                            value="{{ $calificaciones_unidad2->get(0)->calificacion ?? '' }}" disabled>
                    </td>
                    <td>
                        <input type="text" class="form-control text-center"
                            value="{{ $calificaciones_unidad3->get(0)->calificacion ?? '' }}" disabled>
                    </td>
                </tr>
                <tr>
                    <th>{{ $calificaciones_unidad1->get(1)->competencia->nombre_competencia ?? 'Competencia 2' }}</th>
                    <td>
                        <input type="text" class="form-control text-center"
                            value="{{ $calificaciones_unidad1->get(1)->calificacion ?? '' }}" disabled>
                    </td>
                    <td>
                        <input type="text" class="form-control text-center"
                            value="{{ $calificaciones_unidad2->get(1)->calificacion ?? '' }}" disabled>
                    </td>
                    <td>
                        <input type="text" class="form-control text-center"
                            value="{{ $calificaciones_unidad3->get(1)->calificacion ?? '' }}" disabled>
                    </td>
                </tr>
                <tr>
                    <th>{{ $calificaciones_unidad1->get(2)->competencia->nombre_competencia ?? 'Competencia 3' }}</th>
                    <td>
                        <input type="text" class="form-control text-center"
                            value="{{ $calificaciones_unidad1->get(2)->calificacion ?? '' }}" disabled>
                    </td>
                    <td>
                        <input type="text" class="form-control text-center"
                            value="{{ $calificaciones_unidad2->get(2)->calificacion ?? '' }}" disabled>
                    </td>
                    <td>
                        <input type="text" class="form-control text-center"
                            value="{{ $calificaciones_unidad3->get(2)->calificacion ?? '' }}" disabled>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
