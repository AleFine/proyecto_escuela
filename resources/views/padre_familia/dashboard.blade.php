@extends('layout.layout')

@section('contenido')

<main class="container py-5">
    <h1 class="text-center font-weight-bold mb-4">
        Bienvenido, {{ $padre->nombre }}
    </h1>

    <div class="card bg-light shadow-sm p-4 mb-5">
        <h4 class="text-center text-primary font-weight-bold">
            Tus Estudiantes Matriculados
        </h4>
    </div>

    @if(count($padre->hijos) == 0)
        <div class="alert alert-warning text-center" role="alert">
            No tienes hijos registrados.
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($padre->$hijos as $hijo)
                <div class="col">
                    <div class="card shadow-sm h-100">
                        <div class="d-flex justify-content-center mt-3">
                            <img src="{{ $hijo->imagen_rostro }}"
                                 class="card-img-top rounded-circle img-fluid border border-primary"
                                 alt="Foto de {{ $hijo->nombre }}"
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title text-primary font-weight-bold">
                                {{ $hijo->nombre }} {{ $hijo->apellido }}
                            </h5>
                            <p class="card-text text-muted">DNI: {{ $hijo->dni }}</p>
                            <a href="{{ route('padre_familia.show', ['id_alumno' => $hijo->id_alumno]) }}"
                               class="btn btn-primary btn-block">
                                Ver Detalles
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</main>

@endsection
