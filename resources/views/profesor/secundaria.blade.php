@extends('layout.layout')

@section('contenido')

<main class="container py-5">
    <!-- Encabezado -->
    <h3 class="font-weight-bold mb-4 text-primary">
        Docente: {{ $profesor->nombre }} {{ $profesor->apellido }}
    </h3>

    @if(!$docente_seccion)
        <div class="alert alert-warning text-center" role="alert">
            Aún no estas asignado a ningún curso
        </div>
    @else
        <!-- Tarjeta de Información General -->
        <div class="card bg-light shadow-sm p-4 mb-5">
            <h1 class="text-center text-primary mb-4">Cursos Disponibles</h1>
            <div class="d-flex justify-content-between">
                <h4 class="text-primary font-weight-bold">Nivel: Secundaria</h4>
                <h4 class="text-secondary">Año: 2022</h4>
            </div>
        </div>

        @php $i = 0 @endphp

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($docente_seccion as $docente)
                @if($docente->cursos->count() < 1)
                    @php $i++ @endphp
                @else
                    @foreach($docente->cursos as $curso)
                        <div class="col">
                            <div class="card shadow-sm h-100">
                                <div class="card-header text-center bg-gradient-green text-white">
                                    <h5>Grado: {{ $docente->seccion->grado->nombre_grado }}</h5>
                                    <h6>Sección: {{ $docente->seccion->nombre_seccion }}</h6>
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <img src="{{ asset('assets/img/cursito.png') }}"
                                         class="card-img-top img-fluid"
                                         alt="Curso {{ $curso->nombre_curso }}"
                                         style="width: 120px; height: 120px; object-fit: cover;">
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title text-primary">{{ $curso->nombre_curso }}</h5>
                                    <p class="card-text text-muted">ID: {{ $curso->id_curso }}</p>
                                    <a href="{{ route('profesor.show', ['curso' => $curso->id_curso,'profesor'=>$profesor->id_profesor,'docente'=>$docente->id_docente_asignado]) }}"
                                       class="btn btn-primary btn-block">
                                        Ver Estudiantes
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endforeach
        </div>
        @if($i > 0)
            <div class="alert alert-warning text-center mt-4" role="alert">
                El docente no está asignado a ningún curso
            </div>
        @endif
    @endif
</main>

@endsection
