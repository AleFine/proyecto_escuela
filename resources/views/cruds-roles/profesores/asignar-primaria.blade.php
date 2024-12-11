@extends('layout.layout')

@section('contenido')

<div class="container mt-5">
    <h1 class="mb-4 text-center" style="color: skyblue;">Asignar Sección Primaria</h1>

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
                    <form action="{{ route('profes.asignar_seccion_primaria') }}" method="POST">
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

                        <div class="form-group my-3 d-flex gap-3 justify-content-center">
                            <button
                                type="submit"
                                class="btn btn-primary btn-block"
                                {{ $disabled ? 'disabled' : '' }}
                            >
                                Asignar
                            </button>
                            <a href="{{ route('profes.index') }}" class="btn btn-secondary btn-block">Cancelar</a>
                        </div>
                        @if ($disabled)
                            <p class="text-danger text-center">El profesor ya está asignado a una sección de primaria.</p>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white text-center">
                    <h5>Sección</h5>
                </div>
                <div class="card-body">
                    @if($profesor->docente_asignado->count() > 0)
                        <table class="table table-striped text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nivel</th>
                                    <th>Grado</th>
                                    <th>Sección</th>
                                    <th>Visualizar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($profesor->docente_asignado as $docente)
                                    <tr class="text-center">
                                        <td>{{ $docente->seccion->grado->nivel->nombre_nivel }}</td>
                                        <td>{{ $docente->seccion->grado->nombre_grado }}</td>
                                        <td>{{ $docente->seccion->nombre_seccion }}</td>
                                        <td>
                                            <form title="Ver Cursos" action="{{ route('profes.mostrar_cursos_primaria', ['profesor'=>$profesor->id_profesor,'seccion'=>$docente->id_seccion]) }}" method="GET">
                                                <button type="submit" class="btn btn-sm btn-info">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="currentColor"><path d="M6.514 2c-1.304.129-2.182.419-2.838 1.076c-1.175 1.177-1.175 3.072-1.175 6.863v4.02c0 3.79 0 5.686 1.175 6.864S6.743 22 10.526 22h2.007c3.783 0 5.675 0 6.85-1.177c1.067-1.07 1.166-2.717 1.175-5.846"/><path d="m10.526 7l1.003 3.5c.56 1.11 1.263 1.4 3.01 1.5c1.389-.034 2.195-.198 2.883-.796c.469-.408.681-1.023.784-1.635L18.55 7.5m2.508-2v5M8.601 4.933c1.587-1.317 3.001-2.024 5.934-2.802a1.94 1.94 0 0 1 1.009.005c2.596.714 3.998 1.348 5.876 2.758c.08.06.104.172.048.255c-.613.902-1.982 1.633-5.34 2.935a2.98 2.98 0 0 1-2.171-.012c-3.576-1.42-5.22-2.18-5.42-2.969a.17.17 0 0 1 .064-.17"/></g></svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-center">No tiene secciones registradas</p>
                    @endif
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

            const nivelId = parseInt(nivelSeleccionado.value);

            if (nivelId) {
                fetch(`/profe/get_grados/${nivelId}`)
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
                    fetch(`/profe/get_secciones/${gradoId}`)
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
