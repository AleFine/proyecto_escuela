r@extends('layout.layout')

@section('contenido')

<main>
    <h1>Bienvenido Jose Luis</h1>
    <div class="my-3">
        <h4>Cursos del Estudiante {{ $estudiante->nombre }} {{ $estudiante->apellido }}</h4>
    </div>
    <div class="container">
        @if(count($cursos) == 0)
            <div class="alert alert-warning text-center" role="alert">
                El estudiante no tiene cursos registrados
            </div>
        @else
        <div class="row">
            @foreach ($cursos as $curso)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="d-flex justify-content-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/6681/6681144.png" class="card-img-top mt-3" alt="{{ $curso->nombre_curso }}" style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $curso->id_curso }}</h5>
                        <p class="card-text">{{ $curso->nombre_curso }}</p>
                        <a href="#" class="btn btn-primary">Ver Notas</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</main>

@endsection

@section('script')
    <script>
        setTimeout(function() {
            document.querySelector('#mensaje').remove();
        }, 2000);
    </script>
@endsection
