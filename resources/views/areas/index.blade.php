@extends('layout.layout')

@section('contenido')

<div class="container">
    <h3>LISTADO DE ÁREAS ACADÉMICAS</h3>
    <br>

    <form action="{{ route('areas.index') }}" method="GET" class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('areas.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>+ Nuevo Registro</a>
        <div class="d-flex align-items-center">
            <input name="buscarpor" class="form-control mr-2 mx-3" type="search" placeholder="Buscar por nombre" aria-label="Search" value="{{ $buscarpor }}">
            <button class="btn btn-success" type="submit">Buscar</button>
        </div>
    </form>

    <div id="mensaje">
        @if (session('datos'))
            <div class="alert alert-success" role="alert">
                {{ session('datos') }}
            </div>
        @endif
    </div>

    <table class="table table-sm my-3">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre del Área</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody style="font-size: 14x;">
            @if (count($areas) <= 0)
                <tr>
                    <td colspan="13">No hay registros</td>
                </tr>
            @else
                @foreach ($areas as $area)
                    <tr>
                        <td>{{ $area->id_area_academica }}</td>
                        <td>{{ $area->nombre_area }}</td>
                        <td>
                            <a href="{{ route('areas.edit', $area->id_area_academica) }}" class="btn btn-info btn-sm me-3"><i class="fas fa-edit"></i> Editar</a>
                            <a href="{{ route('areas.confirmar', $area->id_area_academica) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Eliminar</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{ $areas->links() }}
</div>

@endsection

@section('script')
    <script>
        setTimeout(function() {
            document.querySelector('#mensaje').remove();
        }, 2000);
    </script>
@endsection
