@extends('layout.layout')

@section('contenido')
    <div class="container">
        <h1>Registro de Nueva Área Académica</h1>
        <form method="POST" action="{{ route('areas.store') }}">
            @csrf
            <div class="form-group mt-2 mb-2">
                <label for="nombre_area">Nombre del Área</label>
                <input type="text" class="form-control @error('nombre_area') is-invalid @enderror" id="nombre_area" name="nombre_area">
                @error('nombre_area')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Grabar</button>
            <a href="{{ route('areas.index') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</a>
        </form>
    </div>
@endsection
