<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Papaya</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/e3989053af.js" ></script>
    <!-- JQuery -->
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/custom_app.css')}}">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-4">
        <a class="navbar-brand" href="/">
            <img src="/logo.svg" alt="logo" style="width:3em;" class="ml-1">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav flex-row ml-md-auto d-md-flex">
                <li class="nav-item m-auto">
                    <div class="form-group has-search m-auto">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input type="text" class="form-control" placeholder="Buscador">
                    </div>
                </li>

                <!-- Authentication Links -->
                @guest
                    <li class="nav-item m-auto pl-3">
                        <a class="nav-link text-marron" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-marron" href="{{ route('register') }}">{{ __('Registro') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item m-auto pl-3">
                        <a class="nav-link" href="{{ route('showForm') }}">
                        <i class="fas fa-plus text-marron">
                        </i>
                        </a>
                    </li>
                    <li class="nav-item m-auto pl-3">
                        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-user text-marron"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Cerrar sesión') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>

                    <li class="nav-item m-auto pl-3 pr-3">
                        <i class="fas fa-heart text-marron"></i>
                    </li>

                @endguest
            </ul>
        </div>
    </nav>
    <main class="">
        <div id="loading-container" style="
            background-color: #2fa360;
            height: 100%;
            width: 100%;
            position: fixed;
            z-index: 10000;
          ">
            <div id="loading">
                <img src="{{asset('images/papaya_loading.gif')}}" alt="" style="
                    height: 8em;
                    width: 8em;
                    border-radius: 20%;

                    position:absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    margin: auto;
                ">
            </div>
        </div>
        @yield('content')
    </main>

    <script>
        window.onload = function(){
            var contenedor = document.getElementById('loading-container');

            contenedor.style.visibility = "hidden";
            contenedor.style.opacity = 0;
            contenedor.style.transition =".4s ease-in 4s";
        }
    </script>
</div>
</body>
</html>
