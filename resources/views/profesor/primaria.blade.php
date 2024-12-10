@extends('layout.layout')

@section('contenido')

<main class="container py-5">
    <h3 class=" font-weight-bold mb-4">
        Docente: {{ $profesor->nombre }} {{ $profesor->apellido }}
    </h3>

    @if(count($cursos) == 0)
        <div class="alert alert-warning text-center" role="alert">
            No hay cursos disponibles.
        </div>
    @else
    <div class="card bg-light mb-5 p-4">
        <h1 class="text-center text-primary mb-5">Cursos Disponibles</h1>
        <div class="d-flex justify-content-between">
            <h4 class="text-primary font-weight-bold">
                Primaria - {{ $seccion->grado->nombre_grado }} Sección "{{ $seccion->nombre_seccion }}"
            </h4>
            <h4 class="text-secondary">Año: 2022</h4>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($cursos as $curso)
            <div class="col">
                <div class="card shadow-sm h-100">
                    <div class="d-flex justify-content-center mt-3">
                        <img src="{{ asset('assets/img/cursito.png') }}" class="card-img-top img-fluid" alt="Curso {{ $curso->nombre_curso }}" style="width: 120px; height: 120px; object-fit: cover;">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title text-primary">{{ $curso->nombre_curso }}</h5>
                        <p class="card-text text-muted">ID: {{ $curso->id_curso }}</p>
                        <a href="{{ route('profesor.show', ['curso' => $curso->id_curso,'profesor'=>$profesor->id_profesor,'seccion'=>$seccion->id_seccion]) }}" class="btn btn-primary btn-block">
                            Ver Estudiantes
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif
</main>

@endsection
