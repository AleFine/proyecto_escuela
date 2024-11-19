@extends('layout.layout')

@section('contenido')
    <div class="container">
        <h1>Crear Nuevo Nivel</h1>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('nivels.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="turno">Turno:</label>
                <input type="text" class="form-control" id="turno" name="turno" value="{{ old('turno') }}" required>
            </div>
            <div class="form-group">
                <label for="nombre_nivel">Nombre del Nivel:</label>
                <input type="text" class="form-control" id="nombre_nivel" name="nombre_nivel" value="{{ old('nombre_nivel') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Crear Nivel</button>
            <a href="{{ route('nivels.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
