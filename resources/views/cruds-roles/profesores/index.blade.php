@extends('layout.layout')

@section('contenido')

<div class="container">
    <h1 class="mb-3 text-center" style="color: red;">Docentes</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card-header d-flex justify-content-between">
        <div class="flex justify-end align-items-center">
            <a href="{{ route('profes.create') }}" class="btn text-lg-center btn-info"> Registrar Docente</a>
        </div>
        <form action="{{ route('profes.search') }}" method="GET">
            <div class="d-flex align-items-center">
                <input name="name_profesor" class="form-control mr-2" type="search" placeholder="Buscar por nombre" aria-label="Search" value="{{ $name_profe ?? ''}}">
                <button class="btn btn-success" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0-14 0m18 11l-6-6"/></svg></button>
            </div>
        </form>
    </div>

    <div class="card mb-4">
        @if($profesores->count() > 0)
        <table class="table table-striped text-center">
            <thead class="text-center">
                <tr>
                    <th>ID Profesor</th>
                    <th>Dni</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha de Ingreso</th>
                    <th>Nivel</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($profesores as $profesor)
                    <tr class="text-center">
                        <td>{{ $profesor->id_profesor }}</td>
                        <td>{{ $profesor->dni }}</td>
                        <td>{{ $profesor->nombre}}</td>
                        <td>{{ $profesor->apellido}}</td>
                        <td>{{ $profesor->fecha_ingreso}}</td>
                        <td>{{ $profesor->nivel->nombre_nivel}}</td>
                        <td class="d-flex justify-content-center align-items-center gap-2">
                            <a title="Editar" href="{{  route('profes.show', $profesor->id_profesor) }}">
                                <button type="submit" class="btn btn-sm btn-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                            <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/>
                                        </g>
                                    </svg>
                                </button>
                            </a>
                            <form title="Eliminar" action="{{ route('profes.destroy', ['profe'=>$profesor->id_profesor]) }}" method="POST" onsubmit="confirmarEliminacion(event, this)">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M2 5.27L3.28 4L5 5.72l.28.28l1 1l2 2L16 16.72l2 2l2 2L18.73 22l-1.46-1.46c-.34.29-.77.46-1.27.46H8c-1.1 0-2-.9-2-2V9.27zM8 19h7.73L8 11.27zM18 7v9.18l-2-2V9h-5.18l-2-2zm-2.5-3H19v2H7.82l-2-2H8.5l1-1h5z"/>
                                    </svg>
                                </button>
                            </form>
                            <a title="Asignar Sección" href="{{ $profesor->id_nivel == 1 ?  route('profes.asignar_primaria', ['profesor'=>$profesor->id_profesor]) :  route('profes.asignar_secundaria', ['profesor'=>$profesor->id_profesor]) }}">
                                <button type="submit" class="btn btn-sm btn-info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="currentColor" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098zM7.25 4h1.5v3.25H12v1.5H8.75V12h-1.5V8.75H4v-1.5h3.25z"/></svg>
                                </button>
                            </a>

                            <a title="Visualizar User" href="{{ route('profes.visualizar', ['profesor'=>$profesor->id_profesor]) }}">
                                <button type="submit" class="btn btn-sm btn-info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 48 48"><g fill="none" stroke="currentColor" stroke-width="4"><path stroke-linejoin="round" d="M24 41c9.941 0 18-8.322 18-14s-8.059-14-18-14S6 21.328 6 27s8.059 14 18 14Z" clip-rule="evenodd"/><path stroke-linejoin="round" d="M24 33a6 6 0 1 0 0-12a6 6 0 0 0 0 12Z"/><path stroke-linecap="round" d="m13.264 11.266l2.594 3.62m19.767-3.176l-2.595 3.62M24.009 7v6"/></g></svg>
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p class="text-center">No hay docentes registrados</p>
        @endif
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $profesores->links() }}
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

