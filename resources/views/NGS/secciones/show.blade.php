@extends('layout.layout')

@section('contenido')
    <div class="container">
        <h1>Detalles de la Sección</h1>
        <a href="{{ route('secciones.index') }}" class="btn btn-secondary mb-3">Regresar</a>
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">ID: {{ $seccion->id_seccion }}</h5>
                <p class="card-text"><strong>Sección:</strong> {{ $seccion->nombre_seccion }}</p>
                <p class="card-text">
                    <strong>Estudiantes Asignados:</strong>  {{ $numEstudiantes }}
                </p>
                <p class="card-text">
                    <strong>Aforo:</strong>  {{ $seccion->aforo }}
                </p>
                <p class="card-text"><strong>Grado:</strong> {{ $seccion->grado->nombre_grado }}</p>
                <p class="card-text"><strong>Nivel:</strong> {{ $seccion->grado->nivel->nombre_nivel }}</p>
                <a href="{{ route('secciones.edit', $seccion->id_seccion) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('secciones.destroy', $seccion->id_seccion) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar esta sección?')">Eliminar</button>
                </form>
            </div>
        </div>

        <h2 class="mt-4">Estudiantes de la sección <strong>{{ $seccion->nombre_seccion }}</strong> </h2>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID Estudiante</th>
                    <th>Nombre Completo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estudiantesSeccion as $matricula)
                    <tr>
                        <td>{{ $matricula->alumno->id_alumno }}</td>
                        <td>{{ $matricula->alumno->nombre }} {{ $matricula->alumno->apellido }}</td>
                        <td>
                            <a href="{{ route('matriculas.edit', ['id_alumno' => $matricula->alumno->id_alumno, 'id_seccion' => $matricula->id_seccion]) }}"
                                class="btn btn-warning">Editar Sección</a>
                            <form action="{{ route('matriculas.destroy', ['id_alumno' => $matricula->alumno->id_alumno, 'id_seccion' => $matricula->id_seccion]) }}"
                                method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea retirar este estudiante?')">Retirar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
