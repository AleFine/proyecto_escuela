@extends('layout.layout')

@section('contenido')
    

    <h1> ¡Bienvenido al Sistema de Gestión Escolar, {{ auth()->user()->name }}!</h1>
@endsection
