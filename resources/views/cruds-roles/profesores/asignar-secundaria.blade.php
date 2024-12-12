@extends('layout.layout')

@section('contenido')

<div class="container mt-5">
    <h1 class="mb-4 text-center" style="color: skyblue;">Asignar Sección Secundaria</h1>

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
                    <h5>Registro de Asignación</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('profes.asignar_seccion_secundaria') }}" method="POST">
                        @csrf
                        <div class="form-group my-3">
                            <label for="nombre">Docente</label>
                            <input type="text" name="nombre" class="form-control" value="{{ $profesor->nombre }} {{ $profesor->apellido }}" readonly>
                            <input type="hidden" name="profesor" value="{{ $profesor->id_profesor }}">
                        </div>

                        <div class="form-group my-3">
                            <label for="nombre">Nivel</label>
                            <input type="text" name="nombre_nivel" class="form-control" value="{{ $profesor->nivel->nombre_nivel }}" readonly>
                            <input type="hidden" name="nivel" id ="nivel" value="{{ $profesor->id_nivel }}">
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

                        <div class="mb-3">
                            <label for="periodo" class="form-label">Periodo</label>
                            <select name="periodo" id="periodo" class="form-select" required>
                                <option value="">Seleccione Periodo</option>
                                @foreach($periodos as $periodo)
                                    <option value="{{ $periodo->id_periodo }}" >
                                        {{ $periodo->nombre_periodo }}</option>
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group my-3 d-flex gap-3 justify-content-center">
                            <button
                                type="submit"
                                class="btn btn-primary btn-block"
                            >
                                Asignar
                            </button>
                            <a href="{{ route('profes.index') }}" class="btn btn-secondary btn-block">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white text-center">
                    <h5>Secciones</h5>
                </div>
                <div class="card-body">
                    @if($profesor->docente_asignado->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nivel</th>
                                        <th>Grado</th>
                                        <th>Sección</th>
                                        <th>Asignar Curso</th>
                                        <th>Eliminar seccion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($profesor->docente_asignado as $docente)
                                        <tr class="text-center">
                                            <td>{{ $docente->seccion->grado->nivel->nombre_nivel }}</td>
                                            <td>{{ $docente->seccion->grado->nombre_grado }}</td>
                                            <td>{{ $docente->seccion->nombre_seccion }}</td>
                                            <td>
                                                <form title="Asignar Curso"
                                                      action="{{ route('profes.asignar_curso_secundaria', ['profesor'=>$profesor->id_profesor,'seccion'=>$docente->id_seccion]) }}"
                                                      method="GET">
                                                    <button type="submit"
                                                            class="btn btn-sm btn-info">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h4.2q.325-.9 1.088-1.45T12 1t1.713.55T14.8 3H19q.825 0 1.413.588T21 5v6.7q-.475-.225-.975-.387T19 11.075V5H5v14h6.05q.075.55.238 1.05t.387.95zm0-3v1V5v6.075V11zm2-1h4.075q.075-.525.238-1.025t.362-.975H7zm0-4h6.1q.8-.75 1.788-1.25T17 11.075V11H7zm0-4h10V7H7zm5-4.75q.325 0 .538-.213t.212-.537t-.213-.537T12 2.75t-.537.213t-.213.537t.213.538t.537.212M18 23q-2.075 0-3.537-1.463T13 18t1.463-3.537T18 13t3.538 1.463T23 18t-1.463 3.538T18 23m-.5-2h1v-2.5H21v-1h-2.5V15h-1v2.5H15v1h2.5z"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('profes.eliminar_asignacion_secundaria', ['profesor' => $profesor->id_profesor, 'seccion' => $docente->id_seccion]) }}"
                                                      method="POST"
                                                      id="form-eliminar-asignacion-{{ $docente->id_seccion }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-danger"
                                                            onclick="confirmarAccion(event, this.closest('form'), true)">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center mt-3">No tiene secciones registradas</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        function confirmarAccion(event, formOrUrl, isDelete) {
            event.preventDefault();
            const title = isDelete ? '¿Estás seguro en eliminar este registro?' : '¿Estás seguro de ver esta matrícula?';
            const text = isDelete ? '¡No podrás revertir esto!' : 'Serás redirigido a los detalles.';
            const confirmButtonText = isDelete ? 'Sí, eliminar' : 'Sí, ver';

            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: isDelete ? '#d33' : '#3085d6',
                cancelButtonColor: '#3085d6',
                confirmButtonText: confirmButtonText,
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (isDelete) {
                        formOrUrl.submit();
                    } else {
                        window.location.href = formOrUrl;
                    }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            const nivelSeleccionado = document.getElementById('nivel');
            const gradoSeleccionado = document.getElementById('grado');
            const seccionSeleccionada = document.getElementById('seccion');

            const nivelId = parseInt(nivelSeleccionado.value);

            if (nivelId) {
                fetch(/profe/get_grados/${nivelId})
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

            gradoSeleccionado.addEventListener('change', function () {
                const gradoId = this.value;
                if(gradoId){
                    fetch(/profe/get_secciones/${gradoId})
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