@extends('layout.layout')

@section('contenido')
    <div class="container">
        <h1>Editar Área Académica</h1>
        <form method="POST" action="{{ route('areas.update', $area->id_area_academica) }}">
            @method('put')
            @csrf
            <div class="form-group my-3">
                <label for="">Código</label>
                <input type="text" class="form-control" id="id_area_academica" name="id_area_academica" value="{{ $area->id_area_academica }}" disabled>
            </div>
            <div class="form-group my-3">
                <label for="">Nombre del Área</label>
                <input type="text" class="form-control @error('nombre_area') is-invalid @enderror" id="nombre_area" name="nombre_area"
                value="{{ $area->nombre_area }}">
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
