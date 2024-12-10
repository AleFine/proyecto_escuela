@extends('layout.layout')

@section('contenido')

<div class="container mt-5">
    <h1 class="mb-4 text-center" style="color: skyblue;">Asignar Relación Padre-Hijo</h1>

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
                    <form action="{{ route('padres.asignar_relacion', ['padre'=>$padre->id_padre_familia]) }}" method="POST">
                        @csrf
                        <div class="form-group my-3">
                            <label for="nombre">Padre de Familia</label>
                            <input type="text" name="nombre" class="form-control" value="{{ $padre->nombre }} {{ $padre->apellido }}" readonly>
                            <input type="hidden" name="padre" value="{{ $padre->id_padre_familia }}">
                        </div>

                        <div class="form-group my-3">
                            <label for="estudiante">Estudiantes</label>
                            <select name="estudiante" class="form-control" id="estudiante" required>
                                <option value="">Selecciona un Estudiante</option>
                                @foreach($estudiantes as $estudiante)
                                    <option value="{{ $estudiante->id_alumno }}">{{ $estudiante->nombre }} {{ $estudiante->apellido }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group my-3 d-flex gap-3 justify-content-center">
                            <button type="submit" class="btn btn-primary btn-block">Asignar</button>
                            <a href="{{ route('padres.index') }}" class="btn btn-secondary btn-block">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white text-center">
                    <h5>Hijos Actuales</h5>
                </div>
                <div class="card-body">
                    @if($padre->hijos->count() > 0)
                        <table class="table table-striped text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID Estudiante</th>
                                    <th>DNI</th>
                                    <th>Nombre y Apellido</th>
                                    <th>Eliminar Relación</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($padre->hijos as $hijo)
                                    <tr class="text-center">
                                        <td>{{ $hijo->id_alumno }}</td>
                                        <td>{{ $hijo->dni }}</td>
                                        <td>{{ $hijo->nombre }} {{ $hijo->apellido }}</td>
                                        <td>
                                            <form title="Eliminar Relacion" action="{{ route('padres.eliminar_relacion', ['padre'=>$padre->id_padre_familia,'estudiante'=>$hijo->id_alumno]) }}" method="POST" onsubmit="confirmarEliminacion(event, this)">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M2 5.27L3.28 4L5 5.72l.28.28l1 1l2 2L16 16.72l2 2l2 2L18.73 22l-1.46-1.46c-.34.29-.77.46-1.27.46H8c-1.1 0-2-.9-2-2V9.27zM8 19h7.73L8 11.27zM18 7v9.18l-2-2V9h-5.18l-2-2zm-2.5-3H19v2H7.82l-2-2H8.5l1-1h5z"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-center">No hay hijos registrados</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        function confirmarEliminacion(event, form) {
            event.preventDefault();
            Swal.fire({
                title: '¿Estás seguro en eliminar este registro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
@endsection
