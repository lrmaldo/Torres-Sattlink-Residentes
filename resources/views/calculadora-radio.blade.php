<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Radio de Transmisión de AP</title>

    {{-- estilos bootstrap  --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"></script>


</head>

<body class="container">
    <h1 class="text-center">Calculadora de Radio de Transmisión de AP</h1>



    <p class="text-muted">Formula del radio de Fresnel:</p>
    <p class="text-muted">
    </p>
    <label for="potencia" class="form-label">Potencia de Transmisión (dBm):</label>
    <input type="number" id="potencia" class="form-control" placeholder="Ej. 20  Corresponde al TX Power"><br><br>

    {{-- potencia de transmision en watts label --}}
    <label for="potencia-watts" class="form-label">Potencia de Transmisión (Watts):</label>
    <input type="number" id="potencia-watts" class="form-control" disabled placeholder=" TX Power"><br><br>

    {{-- Ganancia de la antena --}}
    <label for="ganancia-antena" class="form-label">Ganancia de la Antena (dBi):</label>
    <input type="number" class="form-control" id="ganancia-antena" placeholder="Ej. 10"><br><br>

    {{-- Frecuencia operativa --}}

    <label for="frecuencia-operativa" class="form-label">Frecuencia operativa (Mhz):</label>
    <input type="number" class="form-control" id="frecuencia-operativa" placeholder="Ej. 2"><br><br>


    <button class="btn btn-primary" id="calcular">Calcular Distancia Máxima</button>
    <h3 id="resultado"></h3>

    <script>
        //let potencia = document.getElementById('potencia');
        let potenciaWatts = document.getElementById('potencia-watts');
        let frecuenciaOperativa = document.getElementById('frecuencia-operativa');
        // let gananciaAntena = document.getElementById('ganancia-antena');
        let resultado = document.getElementById('resultado');
        let botonCalcular = document.getElementById('calcular');
        let potenciaTransmision = 37; // Potencia de transmisión en dBm (5W)
        let gananciaAntena = 18; // Ganancia de la antena en dBi
        let frecuenciaGHz = 5.43; // Frecuencia en GHz (5330 MHz)
        let potenciaRecibida = -85; // Potencia recibida en dBm (ajustar según sea necesario)

        // Cálculo de distancia máxima
        function calcularDistanciaMaxima(Pt, Gt, Gr, Pr, f) {
            // Asegúrate de que la operación se realice correctamente
            const d = Math.pow(10, ((Pr - Pt - Gt - Gr) / 20) + Math.log10(f));
            return d; // distancia en km
        }

        let distanciaMaxima = calcularDistanciaMaxima(potenciaTransmision, gananciaAntena, gananciaAntena, potenciaRecibida,
            frecuenciaGHz);
        console.log(`La distancia máxima estimada es: ${distanciaMaxima.toFixed(2)} km`);
    </script>
</body>

</html>
