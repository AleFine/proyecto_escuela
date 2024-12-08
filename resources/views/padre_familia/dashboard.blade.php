@extends('layout.layout')

@section('contenido')

<main>
    <h1>Bienvenido {{ $padre->nombre }}</h1>
    <div class="my-3">
        <h4>Tus Estudiantes Matriculados</h4>
    </div>

        @if(count($hijos) == 0)
            <div class="alert alert-warning text-center" role="alert">
                No tienes hijos registrados.
            </div>
        @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($hijos as $hijo)
                <div class="col">
                    <div class="card mb-4 shadow-sm">
                        <div class="d-flex justify-content-center">
                            <img src="{{ $hijo->imagen_rostro }}" class="card-img-top img-fluid rounded-circle mt-3" alt="Foto de {{ $hijo->nombre }}" style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $hijo->nombre }} {{ $hijo->apellido }}</h5>
                            <p class="card-text">DNI: {{ $hijo->dni }}</p>
                            <div class="d-grid">
                                <a href="{{ route('padre_familia.show',['id_alumno'=>$hijo->id_alumno ]) }}" class="btn btn-primary">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
</main>


@endsection
