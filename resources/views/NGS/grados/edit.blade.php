@extends('layout.layout')

@section('contenido')
    <div class="container">
        <h1>Editar Grado</h1>
        
        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('grados.update', $grado->id_grado) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Campo Nombre del Grado -->
            <div class="form-group">
                <label for="nombre_grado">Nombre del Grado:</label>
                <input type="text" class="form-control" id="nombre_grado" name="nombre_grado" value="{{ old('nombre_grado', $grado->nombre_grado) }}" required>
            </div>

            <!-- Campo Nivel -->
            <div class="form-group">
                <label for="id_nivel">Nivel:</label>
                <select class="form-control" id="id_nivel" name="id_nivel" required>
                    <option value="">Seleccione un nivel</option>
                    @foreach ($niveles as $nivel)
                        <option value="{{ $nivel->id_nivel }}" {{ $nivel->id_nivel == $grado->id_nivel ? 'selected' : '' }}>
                            {{ $nivel->nombre_nivel }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="{{ route('grados.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
