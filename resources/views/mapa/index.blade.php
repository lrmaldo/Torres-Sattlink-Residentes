@extends('layouts.app')

@section('content')
    <style>
        /* Asegurarse de que el mapa ocupe toda la página bajo la barra de navegación */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        /* El mapa ocupará todo el espacio del main sin solaparse con la barra de navegación */
        main {
            height: calc(100vh - 56px);
            /* Ajusta el tamaño de acuerdo a la altura de la navbar */
        }

        #map {
            height: calc(100vh - 66px);
            /* Asegúrate de que el tamaño no sea 0 */
            width: 100%;
        }
    </style>

    <div class="container-fluid p-0">
        <div id="map"></div>
    </div>

    <script>
        (g => {
            var h, a, k, p = "The Google Maps JavaScript API",
                c = "google",
                l = "importLibrary",
                q = "__ib__",
                m = document,
                b = window;
            b = b[c] || (b[c] = {});
            var d = b.maps || (b.maps = {}),
                r = new Set,
                e = new URLSearchParams,
                u = () => h || (h = new Promise(async (f, n) => {
                    await (a = m.createElement("script"));
                    e.set("libraries", [...r] + ",marker"); // Asegúrate de incluir "marker"
                    for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                    e.set("callback", c + ".maps." + q);
                    a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                    d[q] = f;
                    a.onerror = () => h = n(Error(p + " could not load."));
                    a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                    m.head.append(a)
                }));
            d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() =>
                d[l](f, ...n))
        })
        ({
            key: "AIzaSyBDS9ZIrYxrNhDYACm11Vxaw1c_jhpsvMk",
            v: "weekly",
        });



        function initMap() {
            const position = {
                lat: 18.0809029,
                lng: -96.1420957
            };

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 13,
                center: position,
                mapId: "f1b7b3b3b3b3b3b3",
            });

            // Función para crear un círculo en el mapa
            function createCircle(map, center, radius, color) {
                const circle = new google.maps.Circle({
                    strokeColor: "#FF0000",
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: "#FF0000",
                    fillOpacity: 0.35,
                    map,
                    center: center,
                    radius: parseFloat(radius), // Radio en metros
                });
                console.log(circle);
                return circle; // Retornamos el círculo para poder manipularlo si es necesario
            }


            /* Hacer una solicitud  a la api para obtener las torres y dispositivos */

            axios.get('/api/torres-y-dispositivos').then(response => {
                const torres = response.data;

                torres.forEach(torre => {
                    const position = {
                        lat: parseFloat(torre.latitud),
                        lng: parseFloat(torre.longitud)
                    };

                    google.maps.importLibrary("marker").then(() => {
                        // Crear marcador para la torre
                        const marker = new google.maps.Marker({
                            map,
                            position: position,
                            title: torre.nombre,
                            icon: {
                                url: torre.estado == 1 ?
                                    'http://maps.google.com/mapfiles/ms/icons/green-dot.png' :
                                    'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
                            }
                        });

                        const infoWindow = new google.maps.InfoWindow({
                            content: `<h3>${torre.nombre}</h3>
                            <p>${torre.comentarios?? ''}</p>`
                        });

                        marker.addListener('click', () => {
                            infoWindow.open(map, marker);
                        });

                    });

                    /* Aquí es donde el código fallaba, ahora comprobamos que la propiedad `dispositivos` existe y no es null */
                    if (torre.dispositivos && torre.dispositivos.length >
                        0) { // Aseguramos que dispositivos no sea null o vacío
                        torre.dispositivos.forEach(dispositivo => {
                            const devicePosition = {
                                lat: parseFloat(dispositivo.latitud),
                                lng: parseFloat(dispositivo.longitud)
                            };

                            google.maps.importLibrary("marker").then(() => {
                                // Crear marcador para el dispositivo
                                const marker = new google.maps.Marker({
                                    map,
                                    position: devicePosition,
                                    title: dispositivo.hostname,
                                    icon: {
                                        url: dispositivo.estado == 1 ?
                                            'http://maps.google.com/mapfiles/ms/icons/blue-dot.png' :
                                            'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png'
                                    }
                                });

                                const infoWindow = new google.maps.InfoWindow({
                                    content: `<h3>${dispositivo.hostname}</h3>
                                                <img src="/images/${dispositivo.img_url?? 'no-image.png'}" alt="${dispositivo.hostname}" style="width: 100px; height: 100px;">
                                                <p>IP: <a href="http://${dispositivo.ip}" target="_blank">${dispositivo.ip}</a></p>
                                                <p>SSID: ${dispositivo.ssid}</p>
                                                <p>Marca: ${dispositivo.marca}</p>
                                                <p>Modelo: ${dispositivo.modelo}</p>
                                                <p>Comentario: ${dispositivo.comentario?? 'Sin comentario'}</p>`
                                });

                                marker.addListener('click', () => {
                                    infoWindow.open(map, marker);
                                });
                            });

                            /* Si un dispositivo es de tipo AP, dibujamos el radio de transmisión */
                            if (dispositivo.tipo == 'AP') {
                                console.log('dispositivo', dispositivo);
                                // Personaliza el color del círculo según el estado del dispositivo (opcional)
                                const circleColor = dispositivo.estado === 1 ? '#00FF00' :
                                    '#FF0000';

                                // Crea el círculo con un radio personalizado (ajusta el valor según tus necesidades)
                                console.log('dispositivo.radio_transmision', dispositivo
                                    .radio_transmision);
                                const circle = createCircle(map, devicePosition, dispositivo
                                    .radio_transmision,
                                    circleColor); // Radio de 500 metros
                                // map.setCenter(devicePosition);
                                // Puedes agregar eventos al círculo si lo deseas
                                circle.addListener('click', () => {
                                    // Muestra una ventana informativa o realiza alguna otra acción
                                    console.log('Hiciste clic en el círculo');
                                });


                            }
                        });
                    }
                });
            });

        }
        google.maps.importLibrary("maps").then(() => {
            initMap();
        });
    </script>
@endsection
