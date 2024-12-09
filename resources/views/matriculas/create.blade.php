@extends('layout.layout')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Nueva Matrícula</h4>
                </div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('matriculas.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="id_alumno" class="form-label">Alumno</label>
                            <select name="id_alumno" id="id_alumno" class="form-select" required>
                                <option value="">Seleccione un alumno</option>
                                @foreach($alumnos as $alumno)
                                    <option value="{{ $alumno->id_alumno }}" {{ old('id_alumno') == $alumno->id_alumno ? 'selected' : '' }}>
                                        {{ $alumno->nombre }} {{ $alumno->apellido }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="id_periodo" class="form-label">Período</label>
                            <select name="id_periodo" id="id_periodo" class="form-select" required>
                                <option value="">Seleccione un período</option>
                                @foreach($periodos as $periodo)
                                    <option value="{{ $periodo->id_periodo }}" {{ old('id_periodo') == $periodo->id_periodo ? 'selected' : '' }}>
                                        {{ $periodo->nombre_periodo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="id_seccion" class="form-label">Sección</label>
                            <select name="id_seccion" id="id_seccion" class="form-select" required>
                                <option value="">Seleccione una sección</option>
                                @foreach($secciones as $seccion)
                                    <option value="{{ $seccion->id_seccion }}" {{ old('id_seccion') == $seccion->id_seccion ? 'selected' : '' }}>
                                        {{ $seccion->nombre_seccion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select name="estado" id="estado" class="form-select" required>
                                <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('matriculas.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 