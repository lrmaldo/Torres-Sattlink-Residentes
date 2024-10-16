<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
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
            gap: 1rem;
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
            padding: 1rem;
            margin-top: auto;
            color:white
        }
    </style>
</head>
<body>
    <header>
        <img src="/images/Sattlink-2024-logo-blanco.png" alt="Logo de la empresa" class="logo">
        <nav>
            <header> 
            <ul>
                <li><a href="/">Página principal</a></li>
                <li><a href="#">Servicios</a></li>
                <li><a href="{{ route('contacto') }}">Contáctanos</a></li>
                {{-- login --}}
                @if (Route::has('login'))
                    @auth
                        <li><a href="{{ url('/home') }}">Home</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @endif
                    @endauth
                @endif
            </ul>
        </nav>
    </header>

    <main>
        <h1>
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    height: 80vh; /* Altura completa de la ventana */
                    background-image: url('https://images.unsplash.com/photo-1533664488202-6af66d26c44a?q=80&w=1632&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); /* URL de la imagen */
                    background-size: auto ; /* Ajusta la imagen al tamaño de la ventana */
                    background-position: center; /* Centra la imagen */
                    background-repeat: no-repeat; /* Evita que la imagen se repita */
                }
                h1 {
                    color: white; /* Color del texto */
                    text-align: center;
                    margin-top: 20%; /* Espaciado desde la parte superior */
                }
            </style>
        </head>
        <body>
        </h1>
        <p> 
            
        </p>
    </main>

    <footer>
        <p>&copy; 1997 - {{date('Y')}} Derechos Reservados Sattlink.</p>
    </footer>
</body>
</html>
