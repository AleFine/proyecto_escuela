@extends('layout.layout')

@section('contenido')
<section style="background-color: #eee;">
    <div class="container py-3">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="{{ $alumno->imagen_rostro ?? 'https://via.placeholder.com/150' }}" 
                             alt="avatar" 
                             class="rounded-circle img-fluid" 
                             style="width: 150px;">
                        <h5 class="my-3">{{ $alumno->nombre }} {{ $alumno->apellido }}</h5>
                        <p class="text-muted mb-1">DNI: {{ $alumno->dni }}</p>
                        <p class="text-muted mb-4">Región: {{ $alumno->region }} - Ciudad: {{ $alumno->ciudad }}</p>
                        <div class="d-flex justify-content-center mb-2">
                            <a href="{{ route('alumnos.edit', $alumno->id_alumno) }}" class="btn btn-primary">Editar</a>
                            <a href="{{ route('alumnos.index') }}" class="btn btn-outline-primary ms-1">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Nombre Completo</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $alumno->nombre }} {{ $alumno->apellido }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Fecha de Nacimiento</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $alumno->fecha_nacimiento }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Género</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $alumno->genero }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Teléfono</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $alumno->telefono }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Región</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $alumno->region }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Ciudad</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $alumno->ciudad }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Distrito</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $alumno->distrito }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4"><span class="text-primary font-italic me-1">Información adicional</span></h5>
                        <p>sex.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
