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
                                    <option value="{{ $nivel->id_nivel }}" >
                                        {{ $nivel->nombre_nivel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="grado">Grado</label>
                            <select name="grado" class="form-control" id="grado" required>
                                <option value="">Selecciona Grado</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_seccion">Seccion</label>
                            <select name="id_seccion" class="form-control" id="id_seccion" required>
                                <option value="">Selecciona Sección</option>
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

            nivelSeleccionado.addEventListener('change', function (){
                const nivelId = this.value;

                if (nivelId) {
                    fetch(`/matricula/get_grados/${nivelId}`)
                        .then(response => response.json())
                        .then(data => {
                            gradoSeleccionado.innerHTML = '<option value="">Selecciona Grado</option>';
                            data.forEach(grado => {
                                const option = document.createElement('option');
                                option.value = grado.id_grado;
                                option.textContent = grado.nombre_grado;
                                gradoSeleccionado.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error:', error));
                } else {
                    gradoSeleccionado.innerHTML = '<option value="">Selecciona Grado</option>';
                }
            });


            gradoSeleccionado.addEventListener('change', function () {
                const gradoId = this.value;
                if(gradoId){
                    fetch(`/matricula/get_secciones/${gradoId}`)
                       .then(response => response.json())
                       .then(data => {
                            seccionSeleccionada.innerHTML = '<option value="">Selecciona Sección</option>';
                            data.forEach(seccion => {
                                const option = document.createElement('option');
                                option.value = seccion.id_seccion;
                                option.textContent = seccion.nombre_seccion;
                                seccionSeleccionada.appendChild(option);
                            });
                        }).catch(error => console.error('Error:', error));
                }
                else{
                    seccionSeleccionada.innerHTML = '<option value="">Selecciona Sección</option>';
                }
            });

        });


    </script>
@endsection
