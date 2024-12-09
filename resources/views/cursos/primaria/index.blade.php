@extends('layout.layout')

@section('contenido')

<div class="container">
    <h1 class="mb-3 text-center" style="color: red;">Cursos Nivel Primaria</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @foreach($grados as $grado)
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between">
                <h3 style="color: orange;">{{ $grado->nombre_grado }}</h3>
                <div class="flex justify-end align-items-center">
                    <a href="{{ route('cursos.create',['nivel'=> $nivel]) }}" class="btn text-lg-center btn-info"> Nuevo Curso</a>
                </div>
            </div>
            <div class="card-body text-center">
                @if($grado->cursos->count() > 0)
                    <table class="table table-striped text-center">
                        <thead class="text-center">
                            <tr>
                                <th>ID Curso</th>
                                <th>Nombre del Curso</th>
                                <th>Departamento Académico</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grado->cursos as $curso)
                                <tr class="text-center">
                                    <td>{{ $curso->id_curso }}</td>
                                    <td>{{ $curso->nombre_curso }}</td>
                                    <td>{{ $curso->areaAcademica->nombre_area }}</td>
                                    <td class="d-flex justify-content-center align-items-center gap-2">
                                        <a title="Editar" 
                                        href="{{ route('cursos.edit', $curso->id_curso) }}">
                                            <button type="submit" class="btn btn-sm btn-info">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                        <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                                        <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/>
                                                    </g>
                                                </svg>
                                            </button>
                                        </a>
                                        <form action="{{ route('cursos.destroy', ['curso'=>$curso->id_curso]) }}" 
                                        method="POST" 
                                        onsubmit="confirmarEliminacion(event, this)">
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
                    <p class="text-center">No hay cursos registrados</p>
                @endif
            </div>
        </div>
    @endforeach
    <div class="d-flex justify-content-center mt-4">
        {{ $grados->links() }}
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

