@extends('layouts.app')

@section('content')

</style>
<div class="container mt-5 bg-white ">
    <h1 class="mb-4">Agregar Dispositivo</h1>
    <form action="{{ route('dispositivos.update', $dispositivo->id) }}" method="POST"   class="mx-3 mb-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        {{-- input hidden torre_id --}}

        {{--  select  tipo y las opciones serian AP o ST  --}}
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-select" id="tipo" name="tipo">
                <option value="">Seleccione un tipo</option>
                <option value="AP" {{ $dispositivo->tipo == 'AP' ? 'selected' : '' }}>AP</option>
                <option value="ST" {{ $dispositivo->tipo == 'ST' ? 'selected' : '' }}>ST</option>
            </select>
            <span class="text-danger">{{ $errors->first('tipo') }}</span>
        </div>
        <div class="mb-3">
            <label for="hostname" class="form-label">Hostname</label>
            <input type="text" class="form-control" id="hostname" name="hostname" value="{{ old('hostname', $dispositivo->hostname) }}" >
            <span class="text-danger">{{ $errors->first('hostname') }}</span>
        </div>
        <div class="mb-3">
            <label for="ip" class="form-label">IP</label>
            <input type="text" class="form-control" id="ip" name="ip" value="{{ old('ip', $dispositivo->ip) }}" >
            <span class="text-danger">{{ $errors->first('ip') }}</span>
        </div>
        <div class="mb-3">
            <label for="ssid" class="form-label">SSID</label>
            <input type="text" class="form-control" id="ssid" name="ssid" value="{{ old('ssid', $dispositivo->ssid) }}" >
            <span class="text-danger">{{ $errors->first('ssid') }}</span>
        </div>
        {{-- usuario --}}
        <div class="mb-3">
            <label for="usuario" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="usuario" name="usuario" value="{{ old('usuario', $dispositivo->usuario) }}" >
            <span class="text-danger">{{ $errors->first('usuario') }}</span>
        </div>
        {{-- password --}}
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="text" class="form-control" id="password" name="password" value="{{ old('password', $dispositivo->password) }}" >
            <span class="text-danger">{{ $errors->first('password') }}</span>
        </div>
        {{-- numero_de_cliente --}}
        <div class="mb-3">
            <label for="numero_de_cliente" class="form-label">Numero de Cliente</label>
            <input type="text" class="form-control" id="numero_de_cliente" name="numero_de_cliente" value="{{ old('numero_de_cliente', $dispositivo->numero_de_cliente) }}" >
            <span class="text-danger">{{ $errors->first('numero_de_cliente') }}</span>
        </div>
        {{-- marca --}}
        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" class="form-control" id="marca" name="marca" value="{{ old('marca', $dispositivo->marca) }}" >
            <span class="text-danger">{{ $errors->first('marca') }}</span>
        </div>
        {{-- modelo --}}
        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" class="form-control" id="modelo" name="modelo" value="{{ old('modelo', $dispositivo->modelo) }}" >
            <span class="text-danger">{{ $errors->first('modelo') }}</span>
        </div>
        {{--longitud--}}
        <div class="mb-3">
            <label for="longitud" class="form-label">Longitud</label>
            <input type="text" class="form-control" id="longitud" name="longitud" value="{{ old('longitud', $dispositivo->longitud) }}" >
            <span class="text-danger">{{ $errors->first('longitud') }}</span>
        </div>
        {{--latitud--}}
        <div class="mb-3">
            <label for="latitud" class="form-label">Latitud</label>
            <input type="text" class="form-control" id="latitud" name="latitud" value="{{ old('latitud', $dispositivo->latitud) }}" >
            <span class="text-danger">{{ $errors->first('latitud') }}</span>
        </div>
        {{--radiodetransmision--}}
        <div class="mb-3">
            <label for="radiodetransmision" class="form-label">Radio de Transmicion</label>
            <input type="text" class="form-control" id="radiodetransmision" name="radiodetransmision" value="{{ old('radio_transmision', $dispositivo->radio_transmision) }}" >
            <span class="text-danger">{{ $errors->first('radio_transmision') }}</span>
        </div>
        {{-- img_url input file --}}
        <div class="mb-3">
            <label for="img_url" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="img_url" name="img_url" value="{{ old('img_url') }}" accept="image/*">
            <span class="text-danger">{{ $errors->first('img_url') }}</span>
        </div>

        {{-- comentario --}}
        <div class="mb-3">
            <label for="comentario" class="form-label">Comentario</label>
            <textarea class="form-control" id="comentario" name="comentario" rows="3">{{ old('comentario', $dispositivo->comentario) }}
            </textarea>
            <span class="text-danger">{{ $errors->first('comentario') }}</span>
        </div>
        {{-- estado --}}
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-select" id="estado" name="estado">
                <option value="">Seleccione un estado</option>
                <option value="1" {{ $dispositivo->estado == 1 ? 'selected' : '' }}>Activa</option>
                <option value="0" {{ $dispositivo->estado == 0 ? 'selected' : '' }}>Inactiva</option>
                <option value="2" {{ $dispositivo->estado == 2 ? 'selected' : '' }}>En Reparación</option>
            </select>
            <span class="text-danger">{{ $errors->first('estado') }}</span>
        </div>
        <button type="submit" class="btn btn-primary mb-4">Guardar</button>
    </form>
</div>


@endsection
