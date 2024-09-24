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

            google.maps.importLibrary("marker").then(() => {
                // The advanced marker, positioned at Uluru
                const marker = new google.maps.Marker({
                    map,
                    position: position,
                    title: 'Tuxtepec',
                });

                const infoWindow = new google.maps.InfoWindow({
                    content: '<h1>Tuxtepec</h1>'
                });
                marker.addListener('click', () => {
                    infoWindow.open(map, marker);
                });

            });

        }
        google.maps.importLibrary("maps").then(() => {
            initMap();
        });
    </script>

    <script>
        /*   function initMap() {
                const position = {
                    lat: 18.0809029,
                    lng: -96.1420957
                };

                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom:13,
                    center: position,
                    mapId:  "f1b7b3b3b3b3b3b3",
                });

                // The advanced marker, positioned at Uluru
                const marker = new google.maps.marker.AdvancedMarkerElement({
                    map,
                    position: position,
                    title: 'Uluru',
                });

            }

            // Cargar el script de Google Maps de manera asíncrona
            var script = document.createElement('script');
            script.src =
                "https://maps.googleapis.com/maps/api/js?key=AIzaSyBDS9ZIrYxrNhDYACm11Vxaw1c_jhpsvMk&callback=initMap&v=weekly&libraries=marker";
            script.async = true;
            script.defer = true;
            document.head.appendChild(script); */
    </script>
@endsection
