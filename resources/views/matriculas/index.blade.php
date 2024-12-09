@extends('layout.layout')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Lista de Matrículas</h4>
                    <a href="{{ route('matriculas.create') }}" class="btn btn-primary">Nueva Matrícula</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Alumno</th>
                                    <th>Período</th>
                                    <th>Sección</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($matriculas as $matricula)
                                    <tr>
                                        <td>{{ $matricula->id_matricula }}</td>
                                        <td>{{ $matricula->alumno->nombre }} {{ $matricula->alumno->apellido }}</td>
                                        <td>{{ $matricula->periodo->nombre_periodo }}</td>
                                        <td>{{ $matricula->seccion->nombre_seccion }}</td>
                                        <td>
                                            <span class="badge bg-{{ $matricula->estado === 'activo' ? 'success' : 'danger' }}">
                                                {{ ucfirst($matricula->estado) }}
                                            </span>
                                        </td>
                                        <td class="d-flex justify-content-center align-items-center gap-2">
                                        <a href="#" 
                                           class="btn btn-info btn-sm" 
                                           onclick="confirmarAccion(event, '{{ route('matriculas.show', $matricula->id_matricula) }}', false);">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M12 4.5C8.5 4.5 5.5 7 3.5 10c-2 3 0 6.5 3.5 6.5s6-2.5 8-5.5c2-3-1.5-6.5-5-6.5zm0 9c-1.5 0-3-1-3-3s1.5-3 3-3 3 1 3 3-1.5 3-3 3z"/>
                                            </svg>
                                            
                                        </a>
                                            <a title="Editar" 
                                               href="{{ route('matriculas.edit', $matricula->id_matricula) }}">
                                                <button type="submit" class="btn btn-sm btn-info">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                                            <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/>
                                                        </g>
                                                    </svg>
                                                </button>
                                            </a>
                                            <form action="{{ route('matriculas.destroy', $matricula->id_matricula) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="confirmarAccion(event, this, true)">
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
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $matriculas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 

@section('script')
    <script>
        function confirmarAccion(event, formOrUrl, isDelete) {
            event.preventDefault();
            const title = isDelete ? '¿Estás seguro en eliminar este registro?' : '¿Estás seguro de ver esta matrícula?';
            const text = isDelete ? '¡No podrás revertir esto!' : 'Serás redirigido a los detalles.';
            const confirmButtonText = isDelete ? 'Sí, eliminar' : 'Sí, ver';

            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: isDelete ? '#d33' : '#3085d6',
                cancelButtonColor: '#3085d6',
                confirmButtonText: confirmButtonText,
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (isDelete) {
                        formOrUrl.submit();
                    } else {
                        window.location.href = formOrUrl;
                    }
                }
            });
        }
    </script>
@endsection