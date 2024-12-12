
@extends('layout.layout')

@section('contenido')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h2 class="mb-0">Generar Reporte de Notas por Alumno</h2>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('reporte.reporte_notas') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nivel" class="form-label">Nivel</label>
                            <select name="nivel" id="nivel" class="form-select" required>
                                <option value="">Seleccione Nivel</option>
                                @foreach($niveles as $nivel)
                                    <option value="{{ $nivel->id_nivel }}">{{ $nivel->nombre_nivel }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="grado" class="form-label">Grado</label>
                            <select name="grado" class="form-select" id="grado" required>
                                <option value="">Selecciona Grado</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="seccion" class="form-label">Sección</label>
                            <select name="seccion" class="form-select" id="seccion" required>
                                <option value="">Selecciona Sección</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="alumno" class="form-label">Alumno</label>
                            <select name="alumno" class="form-select" id="alumno" required>
                                <option value="">Selecciona Alumno</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="curso" class="form-label">Curso</label>
                            <select name="curso" class="form-select" id="curso" required>
                                <option value="">Selecciona Curso</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-center gap-3 mt-4">
                            <button type="submit" class="btn btn-primary">
                                Generar Reporte
                            </button>
                            <a href="{{ route('reporte.index_admin') }}" class="btn btn-secondary">Atrás</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        transition: all 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .form-select {
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    .btn {
        transition: all 0.3s ease;
    }
    .btn:hover {
        transform: translateY(-2px);
    }
</style>

@endsection

@section('script')
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            const nivelSeleccionado = document.getElementById('nivel');
            const gradoSeleccionado = document.getElementById('grado');
            const seccionSeleccionada = document.getElementById('seccion');
            const alumnoSeleccionado = document.getElementById('alumno');
            const cursoSeleccionado = document.getElementById('curso');

            nivelSeleccionado.addEventListener('change', function (){
                const nivelId = this.value;

                if (nivelId) {
                    fetch(`/reporte/get_grados/${nivelId}`)
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
                    fetch(`/reporte/get_secciones/${gradoId}`)
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

            seccionSeleccionada.addEventListener('change', function () {
                const seccionId = this.value;
                if(seccionId){
                    fetch(`/reporte/get_alumnos/${seccionId}`)
                       .then(response => response.json())
                       .then(data => {
                            alumnoSeleccionado.innerHTML = '<option value="">Selecciona Alumno</option>';
                            data.forEach(alumno => {
                                const option = document.createElement('option');
                                option.value = alumno.id_alumno;
                                option.textContent = alumno.nombre + ' ' + alumno.apellido;
                                alumnoSeleccionado.appendChild(option);
                            });
                        }).catch(error => console.error('Error:', error));
                }
                else{
                    alumnoSeleccionado.innerHTML = '<option value="">Selecciona Alumno</option>';
                }
            });

            alumnoSeleccionado.addEventListener('change', function () {
                const alumnoId = this.value;
                if(alumnoId){
                    fetch(`/reporte/get_cursos/${alumnoId}`)
                       .then(response => response.json())
                       .then(data => {
                            cursoSeleccionado.innerHTML = '<option value="">Selecciona Curso</option>';
                            data.forEach(curso => {
                                const option = document.createElement('option');
                                option.value = curso.id_curso;
                                option.textContent = curso.nombre_curso;
                                cursoSeleccionado.appendChild(option);
                            });
                        }).catch(error => console.error('Error:', error));
                }
                else{
                    cursoSeleccionado.innerHTML = '<option value="">Selecciona Curso</option>';
                }
            });

        });


    </script>
@endsection
