@extends('layout.layout')

@section('contenido')
    <div class="container">
        <h1>Crear Sección</h1>
        <a href="{{ route('secciones.index') }}" class="btn btn-secondary mb-3">Regresar</a>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('secciones.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre_seccion">Sección (Solo una letra mayúscula)</label>
                <input type="text" name="nombre_seccion" class="form-control" value="{{ old('nombre_seccion') }}" 
                       pattern="[A-Z]" title="Solo se permite una letra mayúscula" maxlength="1" required>
                <small class="form-text text-muted">Ingrese una sola letra mayúscula (A-Z)</small>
            </div>
            <div class="form-group">
                <label for="aforo">Aforo</label>
                <input type="number" name="aforo" class="form-control" value="{{ old('aforo') }}" 
                       min="1" required>
                <small class="form-text text-muted">El aforo debe ser mayor a 0</small>
            </div>
            <div class="form-group">
                <label for="id_grado">Grado</label>
                <select name="id_grado" class="form-control" required>
                    <option value="">Seleccione un grado</option>
                    @foreach ($grados as $grado)
                        <option value="{{ $grado->id_grado }}" {{ old('id_grado') == $grado->id_grado ? 'selected' : '' }}>
                            {{ $grado->nombre_grado }} - {{ $grado->nivel->nombre_nivel }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Crear Sección</button>
        </form>
    </div>
@endsection
