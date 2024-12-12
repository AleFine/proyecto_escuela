
@extends('layout.layout')

@section('contenido')

<div class="container mt-5">
    <h1 class="mb-4 text-center" style="color: skyblue;">Generar Reporte De Notas por Alumno</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header text-white text-center" style="background-color: cyan;">
                    <h5>Eliga las Opciones</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('reporte.reporte_notas') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nivel" class="form-label">Nivel</label>
                            <select name="nivel" id="nivel" class="form-select" required>
                                <option value="">Seleccione Nivel</option>
                                @foreach($niveles as $nivel)
                                    <option value="{{ $nivel->id_nivel }}" >
                                        {{ $nivel->nombre_nivel }}</option>
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
                            <label for="seccion">Seccion</label>
                            <select name="seccion" class="form-control" id="seccion" required>
                                <option value="">Selecciona Sección</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="alumno">Alumno</label>
                            <select name="alumno" class="form-control" id="alumno" required>
                                <option value="">Selecciona Alumno</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="curso">Curso</label>
                            <select name="curso" class="form-control" id="curso" required>
                                <option value="">Selecciona Curso</option>
                            </select>
                        </div>

                        <div class="form-group my-3 d-flex gap-3 justify-content-center">
                            <button
                                type="submit"
                                class="btn btn-primary btn-block"
                            >
                                Generar Reporte
                            </button>
                            <a href="{{ route('reporte.index_admin') }}" class="btn btn-secondary btn-block">Atrás</a>
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
                                option.value = alumno.id_seccion;
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
