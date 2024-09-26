<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    {{-- lenguajes datatables --}}
    <script src="{{asset('/js/datatable/lenguajes.js')}}"></script>
    {{-- datatables fuentes --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css">
    {{-- js --}}

    {{-- jquery 3.7.1 --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    {{-- js datatables  2.1.7 --}}
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <!-- importart el sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* bagde */
        .badge {
            font-size: 0.8em;
            padding: 0.5em 0.7em;
            border-radius: 0.35em;
        }
        /* badge badge-success */
        .badge-success {
            background-color: #d1e7dd;
            color: #0f5132;
        }
        /* badge badge-danger */
        .badge-danger {
            background-color: #f8d7da;
            color: #842029;
        }
        /* badge badge-warning */
        .badge-warning {
            background-color: #fff3cd;
            color: #664d03;
        }
        /* badge badge-primary */
        .badge-primary {
            background-color: #cfe2ff;
            color: #084298;
        }

    </style>

</head>

<body>

    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/home') }}">
                {{-- img  y texto alado --}}
                <div class="d-flex align-items-center">
                    <img src="https://sattlink.com/img/Sattlink-logo-nuevo.png" alt="logo" class="img-fluid"
                        width="70">
                    <span class="m-3 ">Torres</span>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">{{ __('Torres') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">{{ __('Usuarios') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{ __('Mapa') }}</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <main class="py-4">
        @yield('content')
    </main>
    <footer class="text-center bg light">
        <p>&copy; {{ date('Y') }} Sattlink Torres</p>

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
