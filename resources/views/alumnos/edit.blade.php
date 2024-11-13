@extends('layout.layout')

@section('contenido')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card border-0 shadow">
        <div class="card-body">
            <h1>Editar Registro de Alumno</h1>
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <h6 class="alert-heading mb-1"><i class="fas fa-exclamation-triangle"></i> Error al actualizar</h6>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <h6 class="alert-heading mb-1"><i class="fas fa-exclamation-triangle"></i> Error del sistema</h6>
                    <p class="mb-0">{{ session('error') }}</p>
                    @if(session('error_details'))
                        <small class="d-block mt-1">Detalles: {{ session('error_details') }}</small>
                    @endif
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form method="POST" action="{{ route('alumnos.update', $alumno->id_alumno) }}" enctype="multipart/form-data">
                @method('put')
                @csrf

                <div class="form-group">
                    <label for="id_alumno">Código</label>
                    <input type="text" class="form-control" id="id_alumno" name="id_alumno" value="{{ $alumno->id_alumno }}" disabled>
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $alumno->nombre) }}">
                    @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control @error('apellido') is-invalid @enderror" id="apellido" name="apellido" value="{{ old('apellido', $alumno->apellido) }}">
                    @error('apellido')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $alumno->fecha_nacimiento) }}">
                    @error('fecha_nacimiento')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="dni">DNI</label>
                    <input type="text" class="form-control @error('dni') is-invalid @enderror" id="dni" name="dni" value="{{ old('dni', $alumno->dni) }}">
                    @error('dni')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="genero">Género</label>
                    <select class="form-control @error('genero') is-invalid @enderror" id="genero" name="genero">
                        <option value="">Seleccione su género</option>
                        <option value="Masculino" {{ old('genero', $alumno->genero) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="Femenino" {{ old('genero', $alumno->genero) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                        <option value="Otros" {{ old('genero', $alumno->genero) == 'Otros' ? 'selected' : '' }}>Otros</option>
                    </select>
                    @error('genero')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="region">Región</label>
                    <select class="form-control @error('region') is-invalid @enderror" id="region" name="region">
                        <option value="">Seleccione una región</option>
                        @foreach($regiones as $region)
                            <option value="{{ $region->id }}" {{ old('region', $alumno->region) == $region->id ? 'selected' : '' }}>{{ $region->nombre }}</option>
                        @endforeach
                    </select>
                    @error('region')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ciudad">Ciudad</label>
                    <select class="form-control @error('ciudad') is-invalid @enderror" id="ciudad" name="ciudad">
                        <option value="">Seleccione una ciudad</option>
                    </select>
                    @error('ciudad')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="distrito">Distrito</label>
                    <select class="form-control @error('distrito') is-invalid @enderror" id="distrito" name="distrito">
                        <option value="">Seleccione un distrito</option>
                    </select>
                    @error('distrito')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono', $alumno->telefono) }}">
                    @error('telefono')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="imagen_rostro">Imagen del Alumno</label>
                    <div class="mb-3">
                        @if ($alumno->imagen_rostro)
                         <img src="{{ $alumno->imagen_rostro }}" alt="Imagen actual" class="mt-2 rounded img-fluid" width="150">
                        @endif
                    </div>
                    
                    <input type="file" class="form-control @error('imagen_rostro') is-invalid @enderror" id="imagen_rostro" name="imagen_rostro" accept="image/*">
                    
                    @error('imagen_rostro')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Grabar</button>
                    <a href="{{ route('alumnos.index') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Cargar las ciudades y distritos con el valor seleccionado en edición
        const regionId = '{{ old('region', $alumno->region) }}';
        const ciudadId = '{{ old('ciudad', $alumno->ciudad) }}';
        const distritoId = '{{ old('distrito', $alumno->distrito) }}';

        if (regionId) {
            fetch(`/get-ciudades?region_id=${regionId}`)
                .then(response => response.json())
                .then(data => {
                    const ciudadSelect = document.getElementById('ciudad');
                    data.forEach(ciudad => {
                        let option = new Option(ciudad.nombre, ciudad.id, ciudad.id == ciudadId);
                        ciudadSelect.add(option);
                    });
                });
        }

        if (ciudadId) {
            fetch(`/get-distritos?ciudad_id=${ciudadId}`)
                .then(response => response.json())
                .then(data => {
                    const distritoSelect = document.getElementById('distrito');
                    data.forEach(distrito => {
                        let option = new Option(distrito.nombre, distrito.id, distrito.id == distritoId);
                        distritoSelect.add(option);
                    });
                });
        }
    });

    document.getElementById('region').addEventListener('change', function() {
        const regionId = this.value;
        fetch(`/get-ciudades?region_id=${regionId}`)
            .then(response => response.json())
            .then(data => {
                const ciudadSelect = document.getElementById('ciudad');
                ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';
                data.forEach(ciudad => {
                    let option = new Option(ciudad.nombre, ciudad.id);
                    ciudadSelect.add(option);
                });
            });
    });

    document.getElementById('ciudad').addEventListener('change', function() {
        const ciudadId = this.value;
        fetch(`/get-distritos?ciudad_id=${ciudadId}`)
            .then(response => response.json())
            .then(data => {
                const distritoSelect = document.getElementById('distrito');
                distritoSelect.innerHTML = '<option value="">Seleccione un distrito</option>';
                data.forEach(distrito => {
                    let option = new Option(distrito.nombre, distrito.id);
                    distritoSelect.add(option);
                });
            });
    });
</script>
@endsection
