@extends('layout.layout')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Editar Matrícula</h4>
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

                    <form action="{{ route('matriculas.update', $matricula->id_matricula) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="id_alumno" class="form-label">Alumno</label>
                            <select name="id_alumno" id="id_alumno" class="form-select" required>
                                <option value="">Seleccione un alumno</option>
                                @foreach($alumnos as $alumno)
                                    <option value="{{ $alumno->id_alumno }}"
                                        {{ old('id_alumno', $matricula->id_alumno) == $alumno->id_alumno ? 'selected' : '' }}>
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
                                    <option value="{{ $periodo->id_periodo }}"
                                        {{ old('id_periodo', $matricula->id_periodo) == $periodo->id_periodo ? 'selected' : '' }}>
                                        {{ $periodo->nombre_periodo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nivel" class="form-label">Nivel</label>
                            <select name="nivel" id="nivel" class="form-select" required>
                                <option value="">Seleccione Nivel</option>
                                @foreach($niveles as $nivel)
                                    <option value="{{ $nivel->id_nivel }}"
                                        {{ old('nivel', $matricula->seccion->grado->nivel->id_nivel) == $nivel->id_nivel ? 'selected' : '' }}>
                                        {{ $nivel->nombre_nivel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="grado" class="form-label">Grado</label>
                            <select name="grado" id="grado" class="form-select" required>
                                <option value="">Seleccione Grado</option>
                                @foreach($grados as $grado)
                                    <option value="{{ $grado->id_grado }}"
                                        {{ old('grado', $matricula->seccion->grado->id_grado) == $grado->id_grado ? 'selected' : '' }}>
                                        {{ $grado->nombre_grado }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="id_seccion" class="form-label">Sección</label>
                            <select name="id_seccion" id="id_seccion" class="form-select" required>
                                <option value="">Seleccione Sección</option>
                                @foreach($secciones as $seccion)
                                    <option value="{{ $seccion->id_seccion }}"
                                        {{ old('id_seccion', $matricula->id_seccion) == $seccion->id_seccion ? 'selected' : '' }}>
                                        {{ $seccion->nombre_seccion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select name="estado" id="estado" class="form-select" required>
                                <option value="activo" {{ old('estado', $matricula->estado) == 'activo' ? 'selected' : '' }}>
                                    Activo
                                </option>
                                <option value="inactivo" {{ old('estado', $matricula->estado) == 'inactivo' ? 'selected' : '' }}>
                                    Inactivo
                                </option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('matriculas.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const nivelSeleccionado = document.getElementById('nivel');
    const gradoSeleccionado = document.getElementById('grado');
    const seccionSeleccionada = document.getElementById('id_seccion');

    // Cargar grados cuando se selecciona un nivel
    nivelSeleccionado.addEventListener('change', function () {
        const nivelId = this.value;

        if (nivelId) {
            fetch(`/matricula/get_grados/${nivelId}`)
                .then(response => response.json())
                .then(data => {
                    gradoSeleccionado.innerHTML = '<option value="">Seleccione Grado</option>';
                    data.forEach(grado => {
                        const option = document.createElement('option');
                        option.value = grado.id_grado;
                        option.textContent = grado.nombre_grado;
                        gradoSeleccionado.appendChild(option);
                    });

                    // Seleccionar el grado actual de la matrícula
                    const gradoActual = "{{ $matricula->seccion->grado->id_grado ?? '' }}";
                    if (gradoActual) {
                        gradoSeleccionado.value = gradoActual;
                    }

                    // Cargar secciones después de cargar los grados
                    const gradoId = gradoSeleccionado.value;
                    if (gradoId) {
                        fetch(`/matricula/get_secciones/${gradoId}`)
                            .then(response => response.json())
                            .then(data => {
                                seccionSeleccionada.innerHTML = '<option value="">Seleccione Sección</option>';
                                data.forEach(seccion => {
                                    const option = document.createElement('option');
                                    option.value = seccion.id_seccion;
                                    option.textContent = seccion.nombre_seccion;
                                    seccionSeleccionada.appendChild(option);
                                });

                                // Seleccionar la sección actual de la matrícula
                                const seccionActual = "{{ $matricula->id_seccion ?? '' }}";
                                if (seccionActual) {
                                    seccionSeleccionada.value = seccionActual;
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    }
                })
                .catch(error => console.error('Error:', error));
        } else {
            gradoSeleccionado.innerHTML = '<option value="">Seleccione Grado</option>';
            seccionSeleccionada.innerHTML = '<option value="">Seleccione Sección</option>';
        }
    });

    // Cargar secciones cuando se selecciona un grado
    gradoSeleccionado.addEventListener('change', function () {
        const gradoId = this.value;

        if (gradoId) {
            fetch(`/matricula/get_secciones/${gradoId}`)
                .then(response => response.json())
                .then(data => {
                    seccionSeleccionada.innerHTML = '<option value="">Seleccione Sección</option>';
                    data.forEach(seccion => {
                        const option = document.createElement('option');
                        option.value = seccion.id_seccion;
                        option.textContent = seccion.nombre_seccion;
                        seccionSeleccionada.appendChild(option);
                    });

                    // Seleccionar la sección actual de la matrícula
                    const seccionActual = "{{ $matricula->id_seccion ?? '' }}";
                    if (seccionActual) {
                        seccionSeleccionada.value = seccionActual;
                    }
                })
                .catch(error => console.error('Error:', error));
        } else {
            seccionSeleccionada.innerHTML = '<option value="">Seleccione Sección</option>';
        }
    });

    // Cargar grados y secciones al cargar la página si ya hay un nivel seleccionado
    const nivelId = nivelSeleccionado.value;
    if (nivelId) {
        nivelSeleccionado.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection
