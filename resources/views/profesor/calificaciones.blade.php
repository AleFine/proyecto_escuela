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

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('profesor.calificar_curso') }}" method="POST">
        @csrf

        <input type="hidden" name="id_matricula" value="{{ $matricula->id_matricula }}">

        <input type="hidden" name="estudiante" value="{{ $estudianteA ->id_alumno }}">
        <input type="hidden" name="curso" value="{{ $cursoA->id_curso }}">

        <h4 class="mb-3">Asignar Calificaciones</h4>

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
                            <input type="text" class="form-control text-center" name="nota1"
                                value="{{ $calificaciones_unidad1->get(0)->calificacion ?? '' }}">
                            <input hidden type="text" name="id_nota1" value="{{ $calificaciones_unidad1->get(0)->id_calificacion  }}">
                        </td>
                        <td>
                            <input type="text" class="form-control text-center" name="nota4"
                                value="{{ $calificaciones_unidad2->get(0)->calificacion ?? '' }}">
                            <input hidden type="text" name="id_nota4" value="{{ $calificaciones_unidad2->get(0)->id_calificacion  }}">
                        </td>
                        <td>
                            <input type="text" class="form-control text-center" name="nota7"
                                value="{{ $calificaciones_unidad3->get(0)->calificacion ?? '' }}">
                            <input hidden type="text" name="id_nota7" value="{{ $calificaciones_unidad3->get(0)->id_calificacion  }}">
                        </td>
                    </tr>
                    <tr>
                        <th>{{ $calificaciones_unidad1->get(1)->competencia->nombre_competencia ?? 'Competencia 2' }}</th>
                        <td>
                            <input type="text" class="form-control text-center" name="nota2"
                                value="{{ $calificaciones_unidad1->get(1)->calificacion ?? '' }}">
                            <input hidden type="text" name="id_nota2" value="{{ $calificaciones_unidad1->get(1)->id_calificacion  }}">
                        </td>
                        <td>
                            <input type="text" class="form-control text-center" name="nota5"
                                value="{{ $calificaciones_unidad2->get(1)->calificacion ?? '' }}">
                            <input hidden type="text" name="id_nota5" value="{{ $calificaciones_unidad2->get(1)->id_calificacion  }}">
                        </td>
                        <td>
                            <input type="text" class="form-control text-center" name="nota8"
                                value="{{ $calificaciones_unidad3->get(1)->calificacion ?? '' }}">
                            <input hidden type="text" name="id_nota8" value="{{ $calificaciones_unidad3->get(1)->id_calificacion  }}">
                        </td>
                    </tr>
                    <tr>
                        <th>{{ $calificaciones_unidad1->get(2)->competencia->nombre_competencia ?? 'Competencia 3' }}</th>
                        <td>
                            <input type="text" class="form-control text-center" name="nota3"
                                value="{{ $calificaciones_unidad1->get(2)->calificacion ?? '' }}">
                            <input hidden type="text" name="id_nota3" value="{{ $calificaciones_unidad1->get(2)->id_calificacion  }}">
                        </td>
                        <td>
                            <input type="text" class="form-control text-center" name="nota6"
                                value="{{ $calificaciones_unidad2->get(2)->calificacion ?? '' }}">
                            <input hidden type="text" name="id_nota6" value="{{ $calificaciones_unidad2->get(2)->id_calificacion  }}">
                        </td>
                        <td>
                            <input type="text" class="form-control text-center" name="nota9"
                                value="{{ $calificaciones_unidad3->get(2)->calificacion ?? '' }}">
                            <input hidden type="text" name="id_nota9" value="{{ $calificaciones_unidad3->get(2)->id_calificacion  }}">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Guardar Calificaciones
            </button>
        </div>
    </form>
</div>

@endsection
