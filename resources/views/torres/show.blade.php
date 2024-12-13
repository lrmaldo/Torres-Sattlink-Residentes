@extends('layouts.app')

@section('content')
    <style>
        .device-image {
            max-width: 100%;
            height: auto;
            max-height: 200px;
            object-fit: contain;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .scrollable-cards {
            max-height: 70vh;
            overflow-y: auto;
        }
        /* secondary color  */
        .bg-secondary {
            background-color: #dd6739 !important;
        }

    </style>


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


            <div class="container mt-2">
                <h2>Lista de Dispositivos de la torre {{$torre->nombre}}</h2>
                <a href="{{ route('dispositivos.create', $torre->id) }}" class="btn btn-info" id="addTowerBtn">
                    <i class="bi bi-plus-circle-fill me-2"></i>
                    Agregar Dispositivos
                </a>

                <div class="table-responsive">
                    <table id="tabla-dispositivos" class="table table-striped table-sm">
                        <thead>

                            <tr>
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>Hostname</th>
                                <th>IP</th>
                                <th>SSID</th>
                                <th>Ubicación</th>
                                <th>Comentario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>

    </div>
    <!-- Modal de Vista de Dispositivo -->

    </style>
    <div class="modal fade modal-lg" id="viewDispositivoModal" tabindex="-1" role="dialog"
        aria-labelledby="viewDispositivoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-black">
                    <h5 class="modal-title" id="viewDispositivoModalLabel">Detalles del Dispositivo: <p id="hostname_title"></p></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body scrollable-cards">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="" alt="Imagen del Dispositivo" id="image_dispositivo"  class="device-image"  >
                        </div>
                        <div class="col-md-6">
                            <p><i class="bi bi-broadcast">&nbsp;&nbsp;</i><strong>Tipo:</strong> <span id="dispositivo-tipo"></span></p>
                            <p><i class="bi bi-bookmark-star">&nbsp;&nbsp;</i><strong>Hostname:</strong> <span id="dispositivo-nombre"></span></p>
                            <p><i class="bi bi-geo-alt-fill">&nbsp;&nbsp;</i><strong>Ubicación:</strong> <a href="" id="dispositivo-ubicacion" target="_blank">Ver
                                    en
                                    Google Maps</a></p>
                            <p><i class="bi bi-pc-display">&nbsp;&nbsp;</i><strong>IP:</strong> <span id="dispositivo-ip"></span></p>
                            <p><i class="bi bi-wifi">&nbsp;&nbsp;</i><strong>SSID:</strong> <span id="dispositivo-ssid"></span></p>
                            <p><i class="bi bi-person-fill">&nbsp;&nbsp;</i><strong>Usuario:</strong> <span id="dispositivo-usuario"></span></p>
                            <p><i class="bi bi-lock">&nbsp;&nbsp;</i><strong>Password:</strong> <span id="dispositivo-password"></span> <button
                                    id="toggle-password" class="btn btn-sm btn-outline-primary">Ver</button></p>
                            <p><i class="bi bi-1-circle">&nbsp;&nbsp;</i><strong>Número de Cliente:</strong> <span id="dispositivo-numero_de_cliente"></span></p>
                            <p><i class="bi bi-award">&nbsp;&nbsp;</i><strong>Marca:</strong> <span id="dispositivo-marca"></span></p>
                            <p><i class="bi bi-box">&nbsp;&nbsp;</i><strong>Modelo:</strong> <span id="dispositivo-modelo"></span></p>
                            <p><i class="bi bi-chat-square-dots">&nbsp;&nbsp;</i></i><strong>Comentario:</strong> <span id="dispositivo-comentario"></span></p>
                            <p><i class="bi bi-toggle-on">&nbsp;&nbsp;</i><strong>Estado:</strong> <span id="dispositivo-estado"></span></p>
                            <p><i class="bi bi-radar">&nbsp;&nbsp;</i><strong>Radio de Transmisión:</strong> <span id="dispositivo-radio_transmision"></span></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-secondary" >
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>

        <script>
            var tablaDispositivos;

            document.addEventListener('DOMContentLoaded', function() {
                tablaDispositivos = $('#tabla-dispositivos').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('dispositivos.data', $torre->id) }}',
                    columns: [{
                            data: 'id',
                        },
                        /* nombre */
                        {
                            data: 'tipo'
                        },
                        {
                            data: 'hostname',
                        },
                        {
                            data: 'ip',
                        },
                        {
                            data: 'ssid',
                        },
                        {
                            data: 'ubicacion',
                        },
                        {
                            data: 'comentario',
                        },
                        {
                            data: 'acciones',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    language: lenguajes
                });
            });


            /* eliminar Dispositivo */
            const eliminarDispositivo = (id) => {

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
                            .delete(`/dispositivos/${id}`)
                            .then(() => {
                                tablaDispositivos.ajax.reload()
                            })
                            .catch((error) => {
                                console.error(error);
                                document.getElementById("error").innerText =
                                    "No se pudo eliminar el dispositivo";
                            });
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: "success",
                            title: "Dispositivo eliminado",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    }
                });
            }


            /* detectar cuando se hace clic en el boton ver */
            $('#tabla-dispositivos').on('click', '.view', function() {
                var data = tablaDispositivos.row($(this).parents('tr')).data();
                console.log(data);

                let estado = data.estado == 1 ? 'Activo' : data.estado == 0 ? 'Inactivo' : 'Mantenimiento';
                $('#viewDispositivoModal').modal('show');
                $('#dispositivo-tipo').text(data.tipo);
                $('#dispositivo-nombre').text(data.hostname);
                $('#hostname_title').text(data.hostname);
                $('#dispositivo-ubicacion').attr('href',
                    `https://www.google.com/maps/search/?api=1&query=${data.latitud},${data.longitud}`);
                $('#dispositivo-ip').text(data.ip);
                $('#dispositivo-ssid').text(data.ssid);
                $('#dispositivo-usuario').text(data.usuario);
                $('#dispositivo-password').text(data.password).hide();
                $('#dispositivo-numero_de_cliente').text(data.numero_de_cliente);
                $('#dispositivo-marca').text(data.marca);
                $('#dispositivo-modelo').text(data.modelo);
                $('#dispositivo-comentario').text(data.comentario);
                $('#dispositivo-estado').text(estado);
                /* radio de transmision */
                $('#dispositivo-radio_transmision').text(data.radio_transmision + ' metros');
                /* imagen del dispositivo */
                $('#image_dispositivo').attr('src', data.img_url);
            });

            $('#toggle-password').click(function() {
                var passwordField = $('#dispositivo-password');
                var isHidden = passwordField.is(':hidden');

                if (isHidden) {
                    passwordField.show(); // Mostrar la contraseña
                    $(this).text('Ocultar'); // Cambiar el texto del botón
                } else {
                    passwordField.hide(); // Ocultar la contraseña
                    $(this).text('Ver'); // Cambiar el texto del botón
                }
            });




            /* vista modal */

        </script>
    @endsection
