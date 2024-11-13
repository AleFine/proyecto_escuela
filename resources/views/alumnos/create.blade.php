@extends('layout.layout')

@section('contenido')
    <div class="container">
        <h1>Registro Nuevo de Alumno</h1>
        <form method="POST" action="{{ route('alumnos.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre">
                @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control @error('apellido') is-invalid @enderror" id="apellido" name="apellido">
                @error('apellido')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" id="fecha_nacimiento" name="fecha_nacimiento">
                @error('fecha_nacimiento')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="dni">DNI</label>
                <input type="text" class="form-control @error('dni') is-invalid @enderror" id="dni" name="dni" maxlength="8" pattern="\d{8}" title="El DNI debe tener 8 dígitos">
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
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otros">Otros</option>
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
                        <option value="{{ $region->id }}">{{ $region->nombre }}</option>
                    @endforeach
                </select>
                @error('region')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="form-group">
                <label for="ciudad">Ciudad</label>
                <select class="form-control @error('ciudad') is-invalid @enderror" id="ciudad" name="ciudad" disabled>
                    <option value="">Seleccione una ciudad</option>
                </select>
                @error('ciudad')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="form-group">
                <label for="distrito">Distrito</label>
                <select class="form-control @error('distrito') is-invalid @enderror" id="distrito" name="distrito" disabled>
                    <option value="">Seleccione un distrito</option>
                </select>
                @error('distrito')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" style="margin-bottom: 5px">
                @error('telefono')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="imagen_rostro">Imagen de Rostro</label>
                <input type="file" 
                       class="form-control @error('imagen_rostro') is-invalid @enderror" 
                       id="imagen_rostro" 
                       name="imagen_rostro" 
                       accept="image/*">
                @if($errors->has('imagen_rostro'))
                    <div class="invalid-feedback">
                        {{ $errors->first('imagen_rostro') }}
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Grabar</button>
            <a href="{{ route('alumnos.index') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</a>
        </form>
    </div>

    <script>
        document.getElementById('region').addEventListener('change', function() {
            const regionId = this.value;
            const ciudadSelect = document.getElementById('ciudad');
            ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';
            ciudadSelect.disabled = true;
            const distritoSelect = document.getElementById('distrito');
            distritoSelect.innerHTML = '<option value="">Seleccione un distrito</option>';
            distritoSelect.disabled = true;

            if (regionId) {
                fetch(`/get-ciudades?region_id=${regionId}`)
                    .then(response => response.json())
                    .then(data => {
                        ciudadSelect.disabled = false;
                        data.forEach(ciudad => {
                            const option = document.createElement('option');
                            option.value = ciudad.id;
                            option.text = ciudad.nombre;
                            ciudadSelect.appendChild(option);
                        });
                    });
            }
        });

        document.getElementById('ciudad').addEventListener('change', function() {
            const ciudadId = this.value;
            const distritoSelect = document.getElementById('distrito');
            distritoSelect.innerHTML = '<option value="">Seleccione un distrito</option>';
            distritoSelect.disabled = true;

            if (ciudadId) {
                fetch(`/get-distritos?ciudad_id=${ciudadId}`)
                    .then(response => response.json())
                    .then(data => {
                        distritoSelect.disabled = false;
                        data.forEach(distrito => {
                            const option = document.createElement('option');
                            option.value = distrito.id;
                            option.text = distrito.nombre;
                            distritoSelect.appendChild(option);
                        });
                    });
            }
        });
    </script>
@endsection
