@extends('layouts.app')

@section('content')
    {{-- trabajar aquiiii --}}

    <div class="container">
        <div class="row justify-content-center">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <h5 class="card-title">Total de Torres</h5>
                            <p class="card-text display-4">{{ $totalTorres }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">Torres Activas</h5>
                            <p class="card-text display-4">{{ $torresActivos }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <h5 class="card-title">Mantenimiento</h5>
                            <p class="card-text display-4">{{ $torresMantenimiento }}</p>
                        </div>
                    </div>
                </div>
                {{-- Torres Inactivos --}}
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <h5 class="card-title ">Torres Inactivas</h5>
                            <p class="card-text display-4">{{ $torresInactivos }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <h2>Lista de Torres</h2>

            <div class="container mt-2">
                <a href="{{ route('torres.create') }}" class="btn btn-info" id="addTowerBtn">
                    <i class="bi bi-plus-circle-fill me-2"></i>
                    Agregar Torre
                </a>

                <div class="table-responsive">
                    <table id="tabla-torres" class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Ubicación</th>
                                <th>Estado</th>
                                <th>Última Revisión</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <h2 class="mt-4">Rendimiento de la Red</h2>
                <div class="bg-light p-3 rounded">
                    <p class="text-center text-muted">Gráfico de rendimiento (Placeholder)</p>
                </div>
            </div>
        </div>
        <script>
            var tablaTorres ;
            document.addEventListener('DOMContentLoaded', function() {
                tablaTorres =  $('#tabla-torres').DataTable({
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

            /* eliminar torre */
            const eliminarTorre = (id)=>{
                /* SweetAlert con preConfirm con la peticion delete de torrre/id  tablaTorre.ajax.reload()*/
                Swal.fire({
                title: "¿Estás seguro?",
                text: "No podrás revertir esto",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar",
                progressSteps: ["1", "2"],
                preConfirm: () => {
                    return axios
                        .delete(`/torres/${id}`)
                        .then(() => {
                            //this.getTorre();
                            tablaTorres.ajax.reload()
                        })
                        .catch((error) => {
                            console.error(error);
                            document.getElementById("error").innerText =
                                "No se pudo eliminar la torre";
                        });
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: "success",
                        title: "Torre eliminado",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            });
        }
        </script>
    @endsection
