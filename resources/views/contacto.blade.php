<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background-color: #f7430e;
            color: rgb(0,0,255);
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;

        }
        .logo {
            width: 180px;
            height: auto;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            gap: 0rem;
        }
        nav ul li a {
            text-decoration: none;
            color:white
        }
        main {
            flex-grow: 1;
            padding: 2rem;
        }
        footer {
            background-color: #f7430e;
            text-align: center;
            padding: 2rem;
            margin-top: auto;
            color:white;

        }
    </style>
</head>
<body>
    <header>
        <img src="/images/Sattlink-2024-logo-blanco.png" alt="Logo de la empresa" class="logo">
        <nav>
            <header>
            <ul>
                <li><a href="{{url('/')}}">Página principal</a></li>

            </ul>
        </nav>
            </header>
            <main>


    <title>Contáctanos</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 20px;
        }
        h1, h2 {
            color: #2c3e50;
        }

        /* Estilos del módulo de contacto */
        .contact-module {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            overflow: hidden;
            display: flex;
            flex-wrap: wrap;
        }
        .company-info, .contact-form {
            padding: 40px;
            width: 50%;
        }
        .company-info {
            background-color: #34495e;
            color: #fff;
        }
        .company-info h2 {
            color: #ecf0f1;
        }
        .info-item {
            margin-bottom: 20px;
        }
        .info-item i {
            margin-right: 10px;
            color: #3498db;
        }

        /* Estilos del formulario */
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        textarea {
            height: 150px;
        }
        button {
            background-color: #3498db;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #2980b9;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .company-info, .contact-form {
                width: 100%;
            }
        }

        /* Estilos de accesibilidad */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }
        #result {
            margin-top: 20px;
            padding: 10px;
            background-color: #e7f3fe;
            border: 1px solid #b6d4fe;
            border-radius: 4px;
            display: none;
        }
        .error {
            color: #d32f2f;
            font-size: 0.9em;
            margin-top: 5px;
        }
        .loading {
            display: none;
            text-align: center;
            margin-top: 20px;
        }
        .loading::after {
            content: "⏳";
            animation: loading 1s infinite;
        }
        @keyframes loading {
            0% { content: "⏳"; }
            33% { content: "⌛"; }
            66% { content: "⏳"; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Contáctanos</h1>
        <div class="contact-module">
            <div class="company-info">
                <h2>Empresa Sattlink</h2>
                <div class="info-item">
                    <i aria-hidden="true">📍</i>
                    <span class="sr-only">Dirección:</span>
                    en Av. Francisco I. Madero lote 10, departamento 5, Fraccionamiento Los Ángeles I etapa, CP 68370 San Juan Bautista Tuxtepec, Oaxaca.
                </div>
                <div class="info-item">
                    <i aria-hidden="true">📞</i>
                    <span class="sr-only">Teléfono:</span>
                    (287) 875-60-19
                </div>
                <div class="info-item">
                    <i aria-hidden="true">✉️</i>
                    <span class="sr-only">Email:</span>
                    info@sattlink.com
                </div>
                <div class="info-item">
                    <i aria-hidden="true">🕒</i>
                    <span class="sr-only">Horario de Atención:</span>
                    Lunes a sábado de 9:00am a 5:00pm.
                    Domingo de 9:00am a 2:00pm
                </div>
            </div>
            <div class="contact-form">
                <h2>Envíanos un mensaje</h2>
                <form id="contactForm">
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Asunto:</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Mensaje:</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>
                    <button type="submit">Enviar Mensaje</button>
                </form>
            <div id="loading" class="loading">Procesando...</div>
            <div id="result"></div>
        </div>

            </div>
        </div>
    </div>

    <script>
        document.getElementById('contact-module').addEventListener('submit', function(e) {
            e.preventDefault();

            // Limpiar errores previos
            document.querySelectorAll('.error').forEach(el => el.textContent = '');

            // Obtener los valores del formulario
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const message = document.getElementById('message').value.trim();

            // Validación
            let isValid = true;

            if (name === '') {
                document.getElementById('nameError').textContent = 'Por favor, ingrese su nombre.';
                isValid = false;
            }

            if (email === '') {
                document.getElementById('emailError').textContent = 'Por favor, ingrese su email.';
                isValid = false;
            } else if (!/\S+@\S+\.\S+/.test(email)) {
                document.getElementById('emailError').textContent = 'Por favor, ingrese un email válido.';
                isValid = false;
            }

            if (message === '') {
                document.getElementById('messageError').textContent = 'Por favor, ingrese un mensaje.';
                isValid = false;
            }

            if (!isValid) return;

            // Mostrar indicador de carga
            document.getElementById('loading').style.display = 'block';

            //proceso de enviar formulario
            fetch('/enviar-email', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    name,
                    email,
                    message
                })
            }).then(response => response.json())
                .then(data => {
                    document.getElementById('loading').style.display = 'none';
                    document.getElementById('result').style.display = 'block';
                    document.getElementById('result').textContent = data.message;
                });
            .catch(error => {
                document.getElementById('loading').style.display = 'none';
                document.getElementById('result').style.display = 'block';
                document.getElementById('result').textContent = 'Ocurrió un error al enviar el mensaje. Por favor, intente de nuevo.';
            })


        });
    </script>

    <footer>
        <p>&copy; 1997 - {{date('Y')}} Derechos Reservados Sattlink.</p>
    </footer>
</body>
</html>
