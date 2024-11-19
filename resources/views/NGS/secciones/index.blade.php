@extends('layout.layout')

@section('contenido')
    <div class="container">
        <h1>Lista de Secciones</h1>
        <a href="{{ route('secciones.create') }}" class="btn btn-primary">Crear Sección</a>

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('secciones.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="grado" class="form-control" placeholder="Buscar por grado" value="{{ request('grado') }}">
                <button class="btn btn-secondary" type="submit">Buscar</button>
            </div>
        </form>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sección</th>
                    <th>Aforo</th>
                    <th>Grado</th>
                    <th>Nivel</th>
                    <th>Turno</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($secciones as $seccion)
                    <tr>
                        <td>{{ $seccion->id_seccion }}</td>
                        <td>{{ $seccion->nombre_seccion }}</td>
                        <td>{{ $seccion->aforo }}</td>
                        <td>{{ $seccion->grado->nombre_grado }}</td>
                        <td>{{ $seccion->grado->nivel->nombre_nivel }}</td>
                        <td>{{ $seccion->grado->nivel->turno }}</td>
                        <td>
                            <a href="{{ route('secciones.show', $seccion->id_seccion) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('secciones.edit', $seccion->id_seccion) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('secciones.destroy', $seccion->id_seccion) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar esta sección?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
