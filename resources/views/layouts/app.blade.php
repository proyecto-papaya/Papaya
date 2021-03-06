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
    <script src="https://kit.fontawesome.com/e3989053af.js"></script>
    <!-- JQuery -->
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>

    <!-- Tablesorter -->
    <script src="{{ asset('/js/jquery.tablesorter.js') }}" defer>
    </script>
    <script src="{{ asset('/js/jquery.tablesorter.widgets.js') }}" defer>
    </script>
        <script>
        $.noConflict(true);
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('css/collapse.css')}}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <a class="navbar-brand" href="/">
            <img src="/logo.svg" alt="logo" style="width:3em;" class="ml-1">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav flex-row ml-md-auto d-md-flex">
                <li class="nav-item m-auto">
                    <div class="form-group has-search m-auto">
                        <form id="formBuscar" action='/home' method="get" >
                        <span class="fa fa-search form-control-feedback"></span>
                            <div class="input-group">
                                <input type="text" class="form-control" name="buscador" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-papaya" type="submit"><b>Buscar</b></button>
                                </div>
                            </div>
                        </form>
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
                        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-user text-marron"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right position-absolute " aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/user/{{Auth::user()->id}}">
                                @if(Auth::user()->profile_picture == 'images/user.png')
                                    <img src="{{ asset('images/user.png') }}" alt="" class="rounded-circle" class="mr-2" style="height: 1em">
                                @else
                                    <img src="{{Storage::url(Auth::user()->profile_picture)}}" alt="" class="rounded-circle" class="mr-2" style="height: 1em">
                                @endif
                                {{ Auth::user()->name }}
                            </a>
                            @if(Auth::user()->role == 'admin')
                                <a class="dropdown-item" href="/admin">Panel admin</a>
                            @endif
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
                    <li class="nav-item m-auto pl-3">
                        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-heart text-marron"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right-fav pt-2 pb-2 position-absolute" aria-labelledby="navbarDropdown">
                            <a class="text-uppercase text-papaya font-weight-bold pb-5 fav-size" id="dropMenu">Favoritos</a>

                            @foreach(Auth::user()->listaFavoritos() as $post)
                                    <div class="row mt-fav">
                                        <div class="ml-2 col-1">{!! $post->icon !!}</div>
                                        <a href="/p/{{$post->id}}" class="col-9 text-marron">
                                            <div class="pb-2">{{$post->title}}</div>
                                        </a>
                                    </div>
                                @endforeach
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
    <main class="">
        <div id="loading-container" class="loading-container">
            <div id="loading">
                <img src="{{asset('images/papaya_loading.gif')}}" class="papaya-gif" alt="Loading papaya">
            </div>
        </div>
        @yield('content')
    </main>

    <script>
        window.onload = function () {
            var contenedor = document.getElementById('loading-container');
            contenedor.style.visibility = "hidden";
            contenedor.style.opacity = 0;
            //contenedor.style.transition = " 0.5s ease-in 0.5s";

        }
    </script>
    <script>
        document.getElementById("formBuscar").addEventListener("keypress", submit(e));
        function submit(e) {
            if(e.which == 10 || e.which == 13) {
                this.form.submit();
        }}
    </script>
</div>
</body>
</html>
