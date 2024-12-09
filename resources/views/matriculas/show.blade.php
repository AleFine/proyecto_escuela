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
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('matriculas.index') }}" class="btn btn-secondary">Volver</a>
                        <div>
                            <a href="{{ route('matriculas.edit', $matricula->id_matricula) }}" 
                               class="btn btn-warning">Editar</a>
                            <form action="{{ route('matriculas.destroy', $matricula->id_matricula) }}" 
                                  method="POST" 
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-danger" 
                                        onclick="return confirm('¿Está seguro de eliminar esta matrícula?')">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Cursos Matriculados</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourseModal">Agregar Curso</button>
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
        </div>
    </div>
</div>

<div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCourseModalLabel">Agregar Curso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('matriculas.cursos.store', $matricula->id_matricula) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="id_curso" class="form-label">Curso</label>
                        <select name="id_curso" id="id_curso" class="form-select" required>
                            <option value="">Seleccione un curso</option>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->id_curso }}">{{ $curso->nombre_curso }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Agregar Curso</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
