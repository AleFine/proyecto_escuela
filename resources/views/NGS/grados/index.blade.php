@extends('layout.layout')

@section('contenido')
    <div class="container">
        <h1>Lista de Grados</h1>
        <a href="{{ route('grados.create') }}" class="btn btn-primary">Crear Grado</a>
        
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
        
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Grado</th>
                    <th>Nivel</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grados as $grado)
                    <tr>
                        <td>{{ $grado->id_grado }}</td>
                        <td>{{ $grado->nombre_grado }}</td>
                        <td>{{ $grado->nivel->nombre_nivel }}</td>
                        <td>
                            <a href="{{ route('grados.show', $grado->id_grado) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('grados.edit', $grado->id_grado) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('grados.destroy', $grado->id_grado) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este grado?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection