@extends('layout.layout')
@section('contenido')
    <div class="container">
        <h1>¿Desea eliminar el registro? Código: {{ $area->id_area_academica }} - Nombre del Área: {{ $area->nombre_area }}</h1>
        <form method="POST" action="{{ route('areas.destroy', $area->id_area_academica) }}">
            @method('delete')
            @csrf
            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif
            <button type="submit" class="btn btn-danger"><i class="fas fa-check-square"></i> SI</button>
            <a href="{{ route('areas.index') }}" class="btn btn-primary"><i class="fas fa-times-circle"></i> NO</a>
        </form>
    </div>
@endsection
