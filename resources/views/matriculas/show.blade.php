@extends('layout.layout')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="mb-0">Detalles de la Matrícula</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center">Información del Alumno</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Nombre</th>
                                    <td>{{ $matricula->alumno->nombre }} {{ $matricula->alumno->apellido }}</td>
                                </tr>
                                <tr>
                                    <th>DNI</th>
                                    <td>{{ $matricula->alumno->dni }}</td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center">Información Académica</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Período</th>
                                    <td>{{ $matricula->periodo->nombre_periodo }}</td>
                                </tr>
                                <tr>
                                    <th>Nivel</th>
                                    <td>{{ $matricula->seccion->grado->nivel->nombre_nivel }}</td>
                                </tr>
                                <tr>
                                    <th>Grado</th>
                                    <td>{{ $matricula->seccion->grado->nombre_grado }}</td>
                                </tr>
                                <tr>
                                    <th>Sección</th>
                                    <td>{{ $matricula->seccion->nombre_seccion }}</td>
                                </tr>
                                <tr>
                                    <th>Estado</th>
                                    <td>
                                        <span class="badge bg-{{ $matricula->estado === 'activo' ? 'success' : 'danger' }}">
                                            {{ ucfirst($matricula->estado) }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 ">Cursos Matriculados</h4>
                </div>
                <div class="card-body">
                    @if($matricula->cursos->count() > 0)
                        <ul class="list-group">
                            @foreach($matricula->cursos as $curso)
                                <li class="list-group-item">{{ $curso->nombre_curso }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No hay cursos matriculados.</p>
                    @endif
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <a href="{{ route('matriculas.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</div>
@endsection

