@extends('layout.layout')

@section('contenido')
    <div class="container">
        <h1>Lista de Niveles</h1>
        <a href="{{ route('nivels.create') }}" class="btn btn-primary">Crear Nivel</a>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Turno</th>
                    <th>Nombre del Nivel</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nivels as $nivel)
                    <tr>
                        <td>{{ $nivel->id_nivel }}</td>
                        <td>{{ $nivel->turno }}</td>
                        <td>{{ $nivel->nombre_nivel }}</td>
                        <td>
                            <a href="{{ route('nivels.show', $nivel->id_nivel) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('nivels.edit', $nivel->id_nivel) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('nivels.destroy', $nivel->id_nivel) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar este nivel?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
