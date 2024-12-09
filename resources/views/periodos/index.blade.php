@extends('layout.layout')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Lista de Períodos</span>
                    <a href="{{ route('periodos.create') }}" class="btn btn-primary btn-sm">Nuevo Período</a>
                </div>

                <div class="card-body">
                    <form method="GET" action="{{ route('periodos.index') }}" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="buscarpor" class="form-control" placeholder="Buscar por nombre..." value="{{ $buscarpor ?? '' }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Buscar</button>
                            </div>
                        </div>
                    </form>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($periodos as $periodo)
                            <tr>
                                <td>{{ $periodo->id_periodo }}</td>
                                <td>{{ $periodo->nombre_periodo }}</td>
                                <td>{{ $periodo->fecha_inicio }}</td>
                                <td>{{ $periodo->fecha_fin }}</td>
                                <td>{{ $periodo->estado }}</td>
                                <td>
                                    <a href="{{ route('periodos.edit', $periodo->id_periodo) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('periodos.destroy', $periodo->id_periodo) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este período?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $periodos->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 