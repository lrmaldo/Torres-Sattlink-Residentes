@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total de Torres</h5>
                        <p class="card-text display-4">{{$totalTorres}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Torres Activas</h5>
                        <p class="card-text display-4">{{$torresActivos}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Mantenimiento</h5>
                        <p class="card-text display-4">{{$torresMantenimiento}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Torres Inactivas</h5>
                        <p class="card-text display-4">{{$torresInactivos}}</p>
                    </div>
                </div>
            </div>
        </div>

        <h2>Lista de Torres</h2>
    
    <div class="container mt-2">       
        <button type="button" class="btn btn-info" id="addTowerBtn">
            <i class="bi bi-plus-circle-fill me-2"></i>
                Agregar Torre
        </button>

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ubicación</th>
                        <th>Estado</th>
                        <th>Última Revisión</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>Ciudad A</td>
                        <td><span class="badge bg-success">Activa</span></td>
                        <td>2023-09-15</td>
                        <td>
                            <button class="btn btn-sm btn-outline-secondary">Ver</button>
                            <button class="btn btn-sm btn-outline-primary">Editar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>Ciudad B</td>
                        <td><span class="badge bg-warning">Mantenimiento</span></td>
                        <td>2023-09-10</td>
                        <td>
                            <button class="btn btn-sm btn-outline-secondary">Ver</button>
                            <button class="btn btn-sm btn-outline-primary">Editar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>003</td>
                        <td>Ciudad C</td>
                        <td><span class="badge bg-danger">Inactiva</span></td>
                        <td>2023-09-05</td>
                        <td>
                            <button class="btn btn-sm btn-outline-secondary">Ver</button>
                            <button class="btn btn-sm btn-outline-primary">Editar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h2 class="mt-4">Rendimiento de la Red</h2>
        <div class="bg-light p-3 rounded">
            <p class="text-center text-muted">Gráfico de rendimiento (Placeholder)</p>
        </div>
    </div>
</div>
@endsection
