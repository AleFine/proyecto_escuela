@extends('layout.layout')

@section('contenido')

<main class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">
            Datos de Usuario de <span class="text-primary">{{ $profesor->nombre }} {{ $profesor->apellido }}</span>
        </h1>
    </div>

    <div class="card shadow-lg border-0">
        <div class="card-header text-white text-center" style="background-color: cyan;">
            <h4 class="fw-bold mb-0">Datos Personales</h4>
        </div>
        <div class="card-body bg-light">
            <div class="row gy-4">
                <div class="col-md-6">
                    <p class="fs-5 mt-3"><strong>ID Usuario:</strong> <span class="text-muted">{{ $profesor->user->id }}</span></p>
                    <p class="fs-5 mt-3"><strong>Nombre de Usuario:</strong> <span class="text-muted">{{ $profesor->user->name }}</span></p>
                    <p class="fs-5 mt-3 mb-3"><strong>Email:</strong> <span class="text-muted">{{ $profesor->user->email }}</span></p>
                </div>
                <div class="col-md-6">
                    <p class="fs-5 mt-4"><strong>Password:</strong> <span class="text-danger">{{ $profesor->dni }}</span></p>
                    <p class="fs-5 mt-4"><strong>Rol:</strong> <span class="badge bg-success text-uppercase">{{ $profesor->user->rol }}</span></p>
                </div>
            </div>
            <div class="card-footer text-center bg-light">
                <a href="{{ route('profes.index') }}" class="btn btn-secondary btn-lg">Volver</a>
            </div>
        </div>
    </div>
</main>

@endsection
