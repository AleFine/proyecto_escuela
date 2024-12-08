@extends('layout.layout')

@section('contenido')

<div class="container mt-2">
    <h2 class="mb-4 text-center" style="color: skyblue;">Nivel Primaria</h2>

    <h3 class="mb-2" style="color: orange;">Crear Curso</h3>

    <div class="row">
        <div class="col-md-6 d-flex justify-content-center">
            <form action="{{ route('cursos.store') }}" method="POST" style="width: 100%;">
                @csrf

                <div class="form-group my-3">
                    <label for="nombre_curso">Nombre del Curso</label>
                    <input type="text" name="nombre_curso" class="form-control" value="{{ old('nombre_curso') }}" required>
                </div>

                <div class="form-group my-3">
                    <label for="grado">Grado</label>
                    <select name="grado" class="form-control" id="grado" required>
                        <option value="">Selecciona un Grado</option>
                        @foreach($grados as $grado)
                            <option value="{{ $grado->id_grado }}">{{ $grado->nombre_grado }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group my-3">
                    <label for="departamento">Departamento Académico</label>
                    <select name="departamento" class="form-control" id="departamento" required>
                        <option value="">Selecciona un Departamento</option>
                        @foreach($departamentos as $departamento)
                            <option value="{{ $departamento->id_area_academica }}">{{ $departamento->nombre_area }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group my-3 d-flex gap-3">
                    <button type="submit" class="btn btn-primary btn-block">Crear</button>
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
