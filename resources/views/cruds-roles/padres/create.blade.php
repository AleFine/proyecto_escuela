@extends('layout.layout')

@section('contenido')

<div class="container mt-2">
    <h2 class="mb-4 text-center" style="color: skyblue;">Registrar Padre de Familia</h2>

    <div class="row">
        <div class="col-md-6 d-flex justify-content-center">
            <form action="{{ route('padres.store') }}" method="POST" style="width: 100%;">
                @csrf
                <div class="form-group my-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                </div>

                <div class="form-group my-3">
                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellido" class="form-control" value="{{ old('apellido') }}" required>
                </div>

                <div class="form-group my-3">
                    <label for="dni">DNI</label>
                    <input type="text" name="dni" class="form-control" value="{{ old('dni') }}" required>
                </div>

                <div class="form-group my-3">
                    <label for="telefono">Telefono</label>
                    <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}" required>
                </div>

                <div class="form-group my-3 d-flex gap-3">
                    <button type="submit" class="btn btn-primary btn-block">Crear</button>
                    <a href="{{ route('padres.index') }}" class="btn btn-secondary btn-block">Cancelar</a>
                </div>
            </form>
        </div>

        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset('assets/img/padres.png') }}" class="img-fluid" style="object-fit: cover; width: 250px; height: 250px;" alt="Descripción de la imagen">
        </div>
    </div>
</div>

@endsection
