<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Bienvenido a Sattlink - Explora nuestros servicios y contáctanos para más información.">
    <title>Página Principal - Sattlink</title>
    <style>
        :root {
            --primary-color: #f7430e;
            --text-color: #ffffff;
            --link-color: #ffffff;
            --heading-color: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: var(--primary-color);
            color: var(--text-color);
            padding: 1rem;
            position: fixed;
            width: 100%;
            z-index: 1000;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            width: 180px;
            height: auto;
        }

        .nav-toggle {
            display: none;
        }

        .nav-toggle-label {
            display: none;
            cursor: pointer;
        }

        .nav-toggle-label span,
        .nav-toggle-label span::before,
        .nav-toggle-label span::after {
            display: block;
            background: var(--text-color);
            height: 2px;
            width: 2rem;
            position: relative;
        }

        .nav-toggle-label span::before,
        .nav-toggle-label span::after {
            content: '';
            position: absolute;
        }

        .nav-toggle-label span::before {
            bottom: 7px;
        }

        .nav-toggle-label span::after {
            top: 7px;
        }

        nav {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            gap: 1rem;
        }

        nav ul li a {
            text-decoration: none;
            color: var(--link-color);


        }

        nav ul li a:hover,
        nav ul li a:focus {
            opacity: 0.5;
        }

        /*  main {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-image: url('https://images.unsplash.com/photo-1533664488202-6af66d26c44a?q=80&w=1632&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: var(--text-color);
        } */

        h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--heading-color);
        }

        footer {
            background-color: var(--primary-color);
            text-align: center;
            padding: 1rem;
            color: var(--text-color);
        }

        @media (max-width: 768px) {
            .header-content {
                flex-wrap: wrap;
            }

            .nav-toggle-label {
                display: block;
            }

            nav {
                width: 100%;
                display: none;
            }

            .nav-toggle:checked~nav {
                display: block;
            }

            nav ul {
                flex-direction: column;
                align-items: center;
                padding: 1rem 0;
            }

            nav ul li {
                width: 100%;
                text-align: center;
            }

            nav ul li a {
                display: block;
                padding: 0rem 0;
            }

            .logo {
                width: 150px;
            }

            h1 {
                font-size: 2rem;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .logo {
                width: 170px;
            }

            h1 {
                font-size: 2.25rem;
            }
        }

        #fondo {
            position: relative;
            width: 100%;
            height: 100vh;
            /* Esto hará que el main ocupe toda la altura de la ventana */
            overflow: hidden;
        }

        .main-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Esto hará que la imagen cubra todo el espacio */
            object-position: center;
            /* Esto centrará la imagen */
        }
    </style>
</head>



<body>
    <header>
        <div class="header-content">
            <img src="/images/Sattlink-2024-logo-blanco.png" alt="Logo de Sattlink" class="logo">
            <input type="checkbox" id="nav-toggle" class="nav-toggle">
            <label for="nav-toggle" class="nav-toggle-label">
                <span></span>
            </label>
            <nav>
                <ul>
                    <li><a href="/">Página principal</a></li>
                   {{--  <li><a href="#servicios">Servicios</a></li> --}}
                    <li><a href="{{ route('contacto') }}">Contáctanos</a></li>
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
        </div>
    </header>

    <main id="fondo">

        <img src="/images/telecomunicaciones.avif" alt="Torre de telecomunicaciones" class="main-image">

    </main>

    <footer>
        <p>&copy; 1997 - {{ date('Y') }} Derechos Reservados Sattlink.</p>
    </footer>
</body>


</html>
