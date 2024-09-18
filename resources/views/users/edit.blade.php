@extends('layouts.app')

@section('content')
 {{-- div con margenes  --}}
    <div class="container">
        {{-- div con margenes  --}}
        <div class="row justify-content-center">
            {{-- div con columnas  --}}
            <div class="col-md-8">
                {{-- div con tarjeta  --}}
                <div class="card">
                    {{-- div con encabezado  --}}
                    <div class="card-header">{{ __('Edit User') }}</div>

                    {{-- div con cuerpo  --}}
                    <div class="card-body">
                        {{-- formulario  --}}
                        <form method="POST" action="{{ route('users.update', $user) }}">
                            {{-- token --}}
                            @csrf
                            {{-- metodo --}}
                            @method('PUT')

                            {{-- div con fila  --}}
                            <div class="row mb-3">
                                {{-- etiqueta  --}}
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                {{-- div con columnas  --}}
                                <div class="col-md-6">
                                    {{-- input  --}}
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

                                    {{-- error  --}}
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
