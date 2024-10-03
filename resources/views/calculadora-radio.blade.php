<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Radio de Transmisión de AP</title>

    {{-- estilos bootstrap  --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.esm.min.js"></script>

</head>

<body class="container">
    <h1 class="text-center">Calculadora de Radio de Transmisión de AP</h1>



    <p class="text-muted">Formula general para calcular la distancia de transmisión:</p>
    <p class="text-muted">d = 10 ^ ((P_t + G_t + G_r - L_p - S) / 20)
    </p>
    <label for="potencia">Potencia de Transmisión (dBm):</label>
    <input type="number" id="potencia" placeholder="Ej. 20  Corresponde al TX Power"><br><br>

    <label for="ganancia-ap">Ganancia de Antena AP (dBi):</label>
    <input type="number" id="ganancia-ap" placeholder="Ej. son los dBi"><br><br>

    <label for="ganancia-receptor">Ganancia de Antena Receptor (dBi):</label>
    <input type="number" id="ganancia-receptor" placeholder="Ej. 2"><br><br>

    <label for="perdida">Pérdida de Propagación (dB):</label>
    <input type="number" id="perdida" placeholder="Ej. 100"><br><br>

    <label for="sensibilidad">Sensibilidad del Receptor (dBm):</label>
    <input type="number" id="sensibilidad" placeholder="Ej. -90"><br><br>

    <button onclick="calcular()">Calcular Radio</button>

    <h3 id="resultado"></h3>

    <script>
        let input_perdida = document.getElementById("perdida");
        input_perdida.addEventListener("input", function() {

        });


        function calcular() {
            // Obtener valores
            let P_t = parseFloat(document.getElementById("potencia").value);
            let G_t = parseFloat(document.getElementById("ganancia-ap").value);
            let G_r = parseFloat(document.getElementById("ganancia-receptor").value);
            let L_p = parseFloat(document.getElementById("perdida").value);
            let S = parseFloat(document.getElementById("sensibilidad").value);

            // Fórmula para calcular distancia
            let d = Math.pow(10, ((P_t + G_t + G_r - L_p - S) / 20));

            // Mostrar resultado
            document.getElementById("resultado").innerHTML = "El radio de transmisión es: " + d.toFixed(2) + " metros.";
        }

        function calculateDistance(txPower, rxGain, txGain, frequency, sensitivity) {
            // FSPL = TX Power + RX Gain + TX Gain - Sensitivity
            let fspl = txPower + rxGain + txGain - sensitivity;

            // Calculamos la distancia en kilómetros
            let distance = Math.pow(10, (fspl - 32.44 - 20 * Math.log10(frequency)) / 20);

            return distance; // Regresa la distancia en kilómetros
        }

        let txPower = 25; // Potencia de transmisión en dBm
        let txGain = 23; // Ganancia de la antena del transmisor en dBi
        let rxGain = 23; // Ganancia de la antena del receptor en dBi
        let frequency = 5440; // Frecuencia en MHz
        let sensitivity = -80; // Sensibilidad del receptor en dBm

        let distance = calculateDistance(txPower, rxGain, txGain, frequency, sensitivity);

        console.log("Distancia de cobertura máxima: " + distance.toFixed(2) + " km");
    </script>
</body>

</html>
