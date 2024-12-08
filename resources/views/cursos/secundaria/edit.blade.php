@extends('layout.layout')

@section('contenido')

<div class="container mt-2">

    <h2 class="mb-4 text-center text-info">Nivel Secundaria</h2>

    <h3 class="mb-2" style="color: orange;">Editar Curso</h3>

    <div class="row">
        <div class="col-md-6 d-flex justify-content-center">
            <form action="{{ route('cursos.update',['curso'=>$curso->id_curso]) }}" method="POST" style="width: 100%;">
                @csrf
                @method('PUT')
                <div class="form-group my-3">
                    <label for="nombre_curso">Nombre del Curso</label>
                    <input type="text" name="nombre_curso" class="form-control" value="{{ $curso->nombre_curso }}" required>
                </div>

                <div class="form-group my-3">
                    <label for="grado">Grado Actual del Curso</label>
                    <select name="grado" class="form-control" id="grado" required>
                        <option value="">Selecciona un Grado</option>
                        @foreach($grados as $grado)
                            <option value="{{ $grado->id_grado }}" {{ $grado->id_grado == $curso->id_grado ? 'selected' : '' }}>{{ $grado->nombre_grado }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group my-3">
                    <label for="departamento">Departamento Académico Actual del Curso</label>
                    <select name="departamento" class="form-control" id="departamento" required>
                        <option value="">Selecciona un Departamento</option>
                        @foreach($departamentos as $departamento)
                            <option value="{{ $departamento->id_area_academica }}" {{ $departamento->id_area_academica == $curso->id_area_academica ? 'selected' : '' }}>{{ $departamento->nombre_area }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group my-3 d-flex gap-3">
                    <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
                    <a href="{{ route('cursos.index',['nivel'=>$nivel]) }}" class="btn btn-secondary btn-block">Cancelar</a>
                </div>
            </form>
        </div>

        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset('assets/img/cursos.png') }}" class="img-fluid w-50" alt="Descripción de la imagen">
        </div>
    </div>
</div>

@endsection
