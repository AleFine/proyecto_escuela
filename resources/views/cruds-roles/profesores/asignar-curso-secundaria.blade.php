@extends('layout.layout')

@section('contenido')
<div class="container py-5">
    <h2>Docente: {{ $profesor->nombre }} {{ $profesor->apellido }}</h2>
    <h1 class="mb-4 text-center text-primary">Cursos en {{ $seccionE->grado->nombre_grado }} Sección {{ $seccionE->nombre_seccion }}</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-info text-white text-center">
                    <h4 class="mb-0">Registro de Asignación</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('profes.registrar_curso_secundaria') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Docente</label>
                            <input type="text" name="nombre" class="form-control" value="{{ $profesor->nombre }} {{ $profesor->apellido }}" readonly>
                            <input type="hidden" name="profesor" value="{{ $profesor->id_profesor }}">
                        </div>

                        <input type="hidden" name="seccion" value="{{ $seccionE->id_seccion }}">

                        <div class="mb-3">
                            <label for="curso" class="form-label">Curso</label>
                            <select name="curso" class="form-select" id="curso" required>
                                <option value="">Selecciona un Curso</option>
                                @foreach($cursos as $curso)
                                    <option value="{{ $curso->id_curso }}">{{ $curso->nombre_curso }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex gap-3 justify-content-center">
                            <button type="submit" class="btn btn-primary">
                                Asignar
                            </button>
                            <a href="{{ route('profes.asignar_secundaria', ['profesor' => $profesor->id_profesor]) }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-success text-white text-center">
            <h4 class="mb-0">Cursos Asignados</h4>
        </div>
        <div class="card-body">
            @if($docentesAsignados->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID Curso</th>
                                <th>Nombre del Curso</th>
                                <th>Departamento Académico</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($docentesAsignados as $docente)
                                @foreach($docente->cursos as $curso)
                                    <tr>
                                        <td>{{ $curso->id_curso }}</td>
                                        <td>{{ $curso->nombre_curso }}</td>
                                        <td>{{ $curso->areaAcademica->nombre_area }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center mt-3">No hay cursos asignados</p>
            @endif
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        transition: all 0.3s;
    }
    .card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    .table th {
        font-weight: 600;
    }
    .btn {
        transition: all 0.3s;
    }
    .btn:hover {
        transform: translateY(-2px);
    }
</style>
@endsection

