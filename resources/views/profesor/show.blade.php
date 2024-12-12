@extends('layout.layout')

@section('contenido')

<main class="container py-5">
    <h3 class=" font-weight-bold mb-4">
        Docente: {{ $profesor->nombre }} {{ $profesor->apellido }}
    </h3>

    <div class="card bg-light mb-5 p-4">
        <h1 class="text-center text-primary mb-5">{{ $curso->nombre_curso }}</h1>
        <div class="d-flex justify-content-between">
            <h4 class="text-primary font-weight-bold">
            {{ $seccion->grado->nivel->nombre_nivel }} - {{ $seccion->grado->nombre_grado }} Sección "{{ $seccion->nombre_seccion }}"
            </h4>
            <h4 class="text-secondary">Año: 2024</h4>
        </div>
    </div>

    <div class="card bg-light shadow-sm p-4 mb-5">
        <h4 class="text-center text-primary font-weight-bold">
            Estudiantes del Curso
        </h4>
    </div>

    <div class="card-body text-center">
        @if($matriculas->count() > 0 )
            <table class="table table-striped text-center">
                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>Nombre y Apellido</th>
                        <th>DNI</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($matriculas as $matricula)
                        @if($matricula->id_seccion == $seccion->id_seccion)
                        <tr class="text-center">
                            <td>{{ $matricula->alumno->id_alumno }}</td>
                            <td>{{ $matricula->alumno->nombre }} {{ $matricula->alumno->apellido }}</td>
                            <td>{{ $matricula->alumno->dni }}</td>
                            <td>
                                <img src="{{ $matricula->alumno->imagen_rostro }}" style="object-fit: cover; width: 30px; height: 30px;" alt="">
                            </td>
                            <td class="d-flex justify-content-center align-items-center gap-2">
                                <!-- Botón Asignar Notas -->
                                <a title="Asignar Notas" href="{{ route('profesor.asignar_calificacion',['curso'=>$curso->id_curso,'estudiante'=>$matricula->alumno->id_alumno]) }}">
                                    <button type="button" class="btn btn-sm btn-info">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M6 22q-.825 0-1.412-.587T4 20V4q0-.825.588-1.412T6 2h8l6 6v12q0 .825-.587 1.413T18 22zm7-13V4H6v16h12V9zM6 4v5zv16z"/>
                                        </svg>
                                    </button>
                                </a>

                                <!-- Botón Generar PDF -->
                                <a title="Generar PDF" href="{{ route('reporte.notas',['id_alumno'=>$matricula->alumno->id_alumno]) }}" target="_blank">
                                    <button type="button" class="btn btn-sm btn-primary">
                                        <i class="fas fa-file-pdf"></i> PDF
                                    </button>
                                </a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center">No hay estudiantes registrados en el curso</p>
        @endif
    </div>
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
