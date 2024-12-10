@extends('layout.layout')

@section('contenido')

<div class="container mt-2">

    <h2 class="mb-4 text-center text-info">Editar Datos Padre de Familia</h2>

    <div class="row">
        <div class="col-md-6 d-flex justify-content-center">
            <form action="{{ route('padres.update',['padre'=>$padre->id_padre_familia]) }}" method="POST" style="width: 100%;">
                @csrf
                @method('PUT')
                <div class="form-group my-3">
                    <label for="nombre">Nombre del Padre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $padre->nombre }}" required>
                </div>

                <div class="form-group my-3">
                    <label for="apellido">Apellido del Padre</label>
                    <input type="text" name="apellido" class="form-control" value="{{ $padre->apellido }}" required>
                </div>

                <div class="form-group my-3">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" value="{{ $padre->telefono }}" required>
                </div>

                <div class="form-group my-3 d-flex gap-3">
                    <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
                    <a href="{{ route('padres.index') }}" class="btn btn-secondary btn-block">Cancelar</a>
                </div>
            </form>
        </div>

        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset('assets/img/padres.png') }}" class="img-fluid w-50" alt="#">
        </div>
    </div>
</div>

@endsection
