@extends('layout.layout')
@section('contenido')
    <div class="container">
        <h1>¿Desea eliminar el Alumno?</h1>
        <div class="mb-3">
            <strong>Código:</strong> {{ $alumno->id_alumno }}<br>
            <strong>Nombre:</strong> {{ $alumno->nombre }} {{ $alumno->apellido }}
            @if($alumno->imagen_rostro)
                <div class="mt-2">
                    <img src="{{ $alumno->imagen_rostro }}" alt="Imagen del alumno" style="max-width: 200px;">
                </div>
            @endif
        </div>
        
        <form method="POST" action="{{ route('alumnos.destroy', $alumno->id_alumno) }}">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-check-square"></i> SI
            </button>
            <a href="{{ route('alumnos.index') }}" class="btn btn-primary">
                <i class="fas fa-times-circle"></i> NO
            </a>
        </form>
    </div>
@endsection