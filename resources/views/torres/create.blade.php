@extends('layouts.app')

@section('content')

</style>
<div class="container mt-5 bg-white">
    <h1 class="mb-4">Agregar Sitios</h1>
    <form action="{{ route('torres.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" >
            <span class="text-danger">{{ $errors->first('nombre') }}</span>
        </div>
        <div class="mb-3">
            <label for="latitud" class="form-label">Latitud</label>
            <input type="text" class="form-control" id="latitud" name="latitud"  value="{{ old('latitud') }}" >
            <span class="text-danger">{{ $errors->first('latitud') }}</span>
        </div>
        <div class="mb-3">
            <label for="longitud" class="form-label">Longitud</label>
            <input type="text" class="form-control" id="longitud" name="longitud" value="{{ old('longitud') }}" >
            <span class="text-danger">{{ $errors->first('longitud') }}</span>
        </div>
        <div class="mb-3">
            <label for="comentarios" class="form-label">Comentarios</label>
            <textarea class="form-control" id="comentarios" name="comentarios" rows="3">
                {{ old('comentarios') }}
            </textarea>
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
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>


@endsection
