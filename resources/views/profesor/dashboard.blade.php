@extends('layout.layout')

@section('contenido')

<main>
    <h1>Bienvenido {{ $profesor->nombre }}</h1>
    <div class="my-3">
        <h1 class="text-center" style="color: blue;">Cursos Disponibles</h1>
        <h2>Primaria</h2>
        <h2>{{ $grado->nombre_grado }} Grado Sección "{{ $seccion->nombre_seccion }}"</h2>
        <h2>Periodo: {{ $periodo->nombre_periodo }}</h2>
    </div>

    @if(count($cursos) == 0)
        <div class="alert alert-warning text-center" role="alert">
            No hay cursos disponibles.
        </div>
    @else
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($cursos as $curso)
            <div class="col">
                <div class="card mb-4 shadow-sm">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/img/cursito.png') }}" class="card-img-top img-fluid rounded-circle mt-3" alt="Curso {{ $curso->nombre_curso }}" style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $curso->nombre_curso }}</h5>
                        <p class="card-text">{{ $curso->id_curso }}</p>
                        <div class="d-grid">
                            <a href="{{ route('profesor.show',['curso'=>$curso->id_curso ]) }}" class="btn btn-primary">Ver Estudiantes</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif
</main>

@endsection
