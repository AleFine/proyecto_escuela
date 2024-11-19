@extends('layout.layout')

@section('contenido')
    <div class="container">
        <h1>Detalles del Grado</h1>
        
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">ID: {{ $grado->id_grado }}</h5>
                <p class="card-text">Nombre del Grado: {{ $grado->nombre_grado }}</p>
                <p class="card-text">Nivel: {{ $grado->nivel->nombre_nivel }}</p>
                <a href="{{ route('grados.edit', $grado->id_grado) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('grados.destroy', $grado->id_grado) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este grado?')">Eliminar</button>
                </form>
                <a href="{{ route('grados.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
    </div>
@endsection
