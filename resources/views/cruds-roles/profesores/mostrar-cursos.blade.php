@extends('layout.layout')

@section('contenido')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg">
                <div class="card-header text-white" style="background-color:palegreen;">
                    <h2 class="mb-0 text-center" >Cursos Asignados</h2>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h3 class="text-primary my-4">Docente: {{ $profesor->nombre }} {{ $profesor->apellido }}</h3>
                        <p class="lead">
                            <span class="badge bg-info text-white me-2">Primaria</span>
                            <span class="badge bg-secondary text-white me-2">Sección: {{ $seccion->nombre_seccion }}</span>
                            <span class="badge bg-secondary text-white">Grado: {{ $seccion->grado->nombre_grado }}</span>
                        </p>
                    </div>

                    @if($cursos->count() > 0)
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
                                    @foreach($cursos as $curso)
                                        <tr>
                                            <td>{{ $curso->id_curso }}</td>
                                            <td>{{ $curso->nombre_curso }}</td>
                                            <td>{{ $curso->areaAcademica->nombre_area }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info text-center" role="alert">
                            No hay cursos registrados para este docente.
                        </div>
                    @endif
                </div>
                <div class="card-footer text-center bg-light">
                    <a href="{{ route('profes.asignar_primaria',["profesor"=>$profesor->id_profesor]) }}" class="btn btn-secondary btn-lg">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        transition: all 0.3s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .table th {
        font-weight: 600;
    }
    .badge {
        font-size: 0.9em;
    }
</style>
@endsection
