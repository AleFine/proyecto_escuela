@extends('layout.layout')

@section('contenido')
    <div class="container">
        <h1>Detalles del Nivel</h1>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">ID: {{ $nivel->id_nivel }}</h5>
                <p class="card-text"><strong>Turno:</strong> {{ $nivel->turno }}</p>
                <p class="card-text"><strong>Nombre del Nivel:</strong> {{ $nivel->nombre_nivel }}</p>
                
                <a href="{{ route('nivels.edit', $nivel->id_nivel) }}" class="btn btn-warning">Editar</a>
                
                <form action="{{ route('nivels.destroy', $nivel->id_nivel) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar este nivel?')">Eliminar</button>
                </form>
                
                <a href="{{ route('nivels.index') }}" class="btn btn-secondary">Volver al Listado</a>
            </div>
        </div>
    </div>
@endsection
