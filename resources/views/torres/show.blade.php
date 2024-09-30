@extends('layouts.app')

@section('content')

<body>
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <h5 class="card-title">Total de Dispositivos</h5>
                            <p class="card-text display-4">{{ $totalDispositivos }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">Dispositivos Activos</h5>
                            <p class="card-text display-4">{{ $DispositivosActivos }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <h5 class="card-title">Mantenimiento</h5>
                            <p class="card-text display-4">{{ $DispositivosMantenimiento }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <h5 class="card-title ">Dispositivos Inactivos</h5>
                            <p class="card-text display-4">{{ $DispositivosInactivos }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <h2>Lista de Dispositivos</h2>

            <div class="container mt-2">
                <a href="{{ route('torres.create') }}" class="btn btn-info" id="addTowerBtn">
                    <i class="bi bi-plus-circle-fill me-2"></i>
                    Agregar Dispositivos
                </a>

                <div class="table-responsive">
                    <table id="tabla-torres" class="table table-striped table-sm">
                        <thead>
                        
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Hostname</th>
                        <th>IP</th>
                        <th>SSID</th>
                        <th>Altitud</th>
                        <th>Latitud</th>
                        <th>Comentario</th>
                    </tr>
                </thead>
            </div>
        </div>
     <script>
        var tablaDispositivos ;
        document.addEventListener('DOMContentLoaded', function() {
            tablaDispositivos =  $('#tabla-Dispositivos').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('torres.data') }}',
                columns: [{
                        data: 'id',
                    },
                    /* nombre */
                    {
                        data:'nombre'
                    },
                    {
                        data: 'ubicacion'
                    },
                    {
                        data: 'estado',
                    },
                    {
                        data: 'ultima_revision'
                    },
                    {
                        data: 'acciones',
                        orderable: false,
                        searchable: false
                    },
                ],
                language: lenguajes
            });
        });


    @endsection
