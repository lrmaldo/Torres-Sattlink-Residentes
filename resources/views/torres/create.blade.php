@extends('layouts.app')

@section('content')
    </style>
    <div class="container mt-5 bg-white ">
        <h1 class="mb-4">Agregar Sitios</h1>
        <form action="{{ route('torres.store') }}" method="POST" class="mx-3 mb-3">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}">
                <span class="text-danger">{{ $errors->first('nombre') }}</span>
            </div>
            <div class="mb-3">
                <label for="latitud" class="form-label">Latitud</label>
                <input type="text" class="form-control" id="latitud" name="latitud" value="{{ old('latitud') }}">
                <span class="text-danger">{{ $errors->first('latitud') }}</span>
            </div>
            <div class="mb-3">
                <label for="longitud" class="form-label">Longitud</label>
                <input type="text" class="form-control" id="longitud" name="longitud" value="{{ old('longitud') }}">
                <span class="text-danger">{{ $errors->first('longitud') }}</span>
            </div>
            <div class="mb-3">
                <label for="comentarios" class="form-label">Comentarios</label>
                <textarea class="form-control" id="comentarios" name="comentarios" rows="3">{{ old('comentarios') }}</textarea>
                <span class="text-danger">{{ $errors->first('comentarios') }}</span>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" id="estado" name="estado">
                    <option value="">Seleccione un estado</option>
                    <option value="1">Activa</option>
                    <option value="0">Inactiva</option>
                    <option value="2">En mantenimiento</option>
                </select>
                <span class="text-danger">{{ $errors->first('estado') }}</span>
            </div>
            {{-- direccion --}}
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion') }}">
                <span class="text-danger">{{ $errors->first('direccion') }}</span>
            </div>
            {{-- altura --}}
            <div class="mb-3">
                <label for="altura" class="form-label">Altura</label>
                <input type="text" class="form-control" id="altura" name="altura" value="{{ old('altura') }}"
                    onkeypress="return validateInput(event, this);" placeholder="Ingresar solo numeros">
                <span class="text-danger">{{ $errors->first('altura') }}</span>
            </div>
            <button type="submit" class="btn btn-primary mb-4">Guardar</button>
        </form>
    </div>

    <script>
        function validateInput(event, input) {
            const charCode = event.charCode;
            const currentValue = input.value;
            const decimalIndex = currentValue.indexOf('.');

            // Permitir números (0-9)
            if (charCode >= 48 && charCode <= 57) {
                // Si ya existe un punto decimal, verificar que no haya más de dos dígitos después de él
                if (decimalIndex !== -1) {
                    const decimals = currentValue.substring(decimalIndex + 1);
                    if (decimals.length >= 2) {
                        return false; // No permitir más de dos dígitos después del punto
                    }
                }
                return true;
            }

            // Permitir solo un punto decimal
            if (charCode == 46 && decimalIndex === -1) {
                return true;
            }

            // Evitar guiones (-) u otros caracteres
            return false;
        }
    </script>
    @endsection
