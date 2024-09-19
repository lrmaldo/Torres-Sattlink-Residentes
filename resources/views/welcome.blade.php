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
            background-color: #f8f9fa;
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
            color: #333;
        }
        main {
            flex-grow: 1;
            padding: 2rem;
        }
        footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 1rem;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <header>
        <img src="https://sattlink.com/img/Sattlink-logo-nuevo.png" alt="Logo de la empresa" class="logo">
        <nav>
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Acerca de</a></li>
                <li><a href="#">Servicios</a></li>
                <li><a href="#">Contacto</a></li>
                {{-- login --}}
                @if (Route::has('login'))
                    @auth
                        <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
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
        <h1></h1>
        <p></p>
    </main>

    <footer>
        <p>&copy; 1997-2024 Derechos Reservados Sattlink.</p>
    </footer>
</body>
</html>
