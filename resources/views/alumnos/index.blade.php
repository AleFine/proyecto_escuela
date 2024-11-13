@extends('layout.layout')

@section('contenido')

<style>
    button {
        margin: 3px;
    }
</style>
<div class="container">
    <h3>LISTADO DE ALUMNOS</h3>
    <br>
    <form action="{{ route('alumnos.index') }}" method="GET" class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('alumnos.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> + Nuevo Registro</a>
        <div class="d-flex align-items-center">
            <input name="buscarpor" class="form-control mr-2" type="search" placeholder="Buscar por nombre" aria-label="Search" value="{{ $buscarpor }}">
            <button class="btn btn-success" type="submit">Buscar</button>
        </div>
    </form>

    <div id="mensaje">
        @if (session('datos'))
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                {{ session('datos') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
    
    <div style="margin-bottom: 10px" class="table-responsive">
        <table class="table table-sm">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Fecha de Nacimiento</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Género</th>
                    <th scope="col">Región</th>
                    <th scope="col">Ciudad</th>
                    <th scope="col">Distrito</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody style="font-size: 10px;">
                @if (count($alumnos) <= 0)
                    <tr>
                        <td colspan="12">No hay registros</td>
                    </tr>
                @else
                    @foreach ($alumnos as $alumno)
                        <tr>
                            <td>{{ $alumno->id_alumno }}</td>
                            <td>{{ $alumno->nombre }}</td>
                            <td>{{ $alumno->apellido }}</td>
                            <td>{{ $alumno->fecha_nacimiento }}</td>
                            <td>{{ $alumno->dni }}</td>
                            <td>{{ $alumno->genero }}</td>
                            <td>{{ $alumno->region }}</td>
                            <td>{{ $alumno->ciudad }}</td>
                            <td>{{ $alumno->distrito }}</td>
                            <td>{{ $alumno->telefono }}</td>
                            <td style="padding-left: 10px;">
                                <a title="Editar" href="{{ route('alumnos.edit', $alumno->id_alumno) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                            <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/>
                                        </g>
                                    </svg>
                                </a>
                                <a style="margin-left: 5px" title="Eliminar" href="{{ route('alumnos.confirmar', $alumno->id_alumno) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M2 5.27L3.28 4L5 5.72l.28.28l1 1l2 2L16 16.72l2 2l2 2L18.73 22l-1.46-1.46c-.34.29-.77.46-1.27.46H8c-1.1 0-2-.9-2-2V9.27zM8 19h7.73L8 11.27zM18 7v9.18l-2-2V9h-5.18l-2-2zm-2.5-3H19v2H7.82l-2-2H8.5l1-1h5z"/>
                                    </svg>
                                </a>
                                <a style="margin-left: 5px" title="Perfil" href="{{ route('alumnos.show', $alumno->id_alumno) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21px" height="21px" viewBox="0 0 24 24"><g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"><path d="M16 9a4 4 0 1 1-8 0a4 4 0 0 1 8 0m-2 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0"/><path d="M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11s11-4.925 11-11S18.075 1 12 1M3 12c0 2.09.713 4.014 1.908 5.542A8.99 8.99 0 0 1 12.065 14a8.98 8.98 0 0 1 7.092 3.458A9 9 0 1 0 3 12m9 9a8.96 8.96 0 0 1-5.672-2.012A6.99 6.99 0 0 1 12.065 16a6.99 6.99 0 0 1 5.689 2.92A8.96 8.96 0 0 1 12 21"/></g></svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    {{ $alumnos->links() }}
</div>

@endsection

@section('script')
    <script>
        setTimeout(function() {
            document.querySelector('#mensaje').remove();
        }, 2000);
    </script>
@endsection
