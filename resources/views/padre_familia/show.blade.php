@extends('layout.layout')

@section('contenido')

<main class="container py-5">
    <h1 class="text-center font-weight-bold mb-4">
        Bienvenido, {{ $estudiante->padres[0]->nombre }} {{ $estudiante->padres[0]->apellido }}
    </h1>

    <div class="card bg-light shadow-sm p-4 mb-5">
        <h4 class="text-center text-primary font-weight-bold">
            Cursos del Estudiante: {{ $estudiante->nombre }} {{ $estudiante->apellido }}
        </h4>
    </div>

    @if(count($cursos) == 0)
        <div class="alert alert-warning text-center" role="alert">
            El estudiante no tiene cursos registrados
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($cursos as $curso)
                <div class="col">
                    <div class="card shadow-sm h-100">
                        <div class="d-flex justify-content-center mt-3">
                            <img src="https://cdn-icons-png.flaticon.com/512/6681/6681144.png"
                                 class="card-img-top img-fluid"
                                 alt="{{ $curso->nombre_curso }}"
                                 style="width: 100px; height: 100px; object-fit: cover;">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title text-primary font-weight-bold">{{ $curso->id_curso }}</h5>
                            <p class="card-text text-muted">{{ $curso->nombre_curso }}</p>
                            <a href="#" class="btn btn-primary btn-block">Ver Notas</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</main>

@endsection

@section('script')
    <script>
        setTimeout(function() {
            const mensaje = document.querySelector('#mensaje');
            if (mensaje) mensaje.remove();
        }, 2000);
    </script>
@endsection
