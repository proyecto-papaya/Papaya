@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row border-bottom p-4">
            <div class="col-1">
                @if($user->name == Auth::user()->name)
                    <button href="/edit_profile_picture" onclick=" document.getElementById('profile-picture-input').click();" style="border: 0; background: transparent;">
                            <img src="{{asset($user->profile_picture)}}" class="rounded-circle" alt="" style="width: 3em;">
                    </button>
                    <form class="d-none" id="profile-picture-form" action="/edit_profile_picture" method="POST">
                        @csrf
                        <input id="profile-picture-input" type=file name="profile_picture">
                    </form>
                @else
                    <div>
                        <img src="{{asset($user->profile_picture)}}" class="rounded-circle" alt="" style="width: 3em;">
                    </div>
                @endif
            </div>

            <div class="col-3">{{$user->name}}</div>

            @if($user->name == Auth::user()->name)
            <div class="col-3">123 seguidores</div>
            <div class="col-3">123 siguiendo</div

            <div class="col-3">

                    <div class="dropdown">
                        <div id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cog" onclick="show()"></i>
                        </div>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <button class="dropdown-item" type="button"><a class="text-marron" href="#">Editar Perfil</a></button>
                            <button class="dropdown-item" type="button"><a class="text-marron" href="#">Cambiar Contraseña</a></button>
                            <button class="dropdown-item" type="button"><a class="text-marron" href="#">Eliminar Cuenta</a></button>
                        </div>
                    </div>
            @else
                <div class="col-6">
                    <button type="button" class="btn btn-outline-dark">Seguir</button>
                </div>
            @endif
            </div>
        <div class="row">
            <div class="col-12">{{$user->description}}</div>
        </div>
        <div class="row">
            <div class="col-2 offset-7 mt-3">
                <div class="form-group has-search m-auto">
                    <span class="fa fa-search form-control-feedback"></span>
                    <input type="text" class="form-control" placeholder="Buscador">
                </div>
            </div>
        </div>

        <div class="row">
            @if(count($user->posts))
                @foreach($user->posts as $post)
                    <div class="col-3">
                        <div>
                            {!! $post->archivos->first()->icon !!}
                        </div>
                        <div>{{$post->title}}</div>
                    </div>
                @endforeach
            @else
                <p class="mt-5 ml-5" id="upsi" >¡Ups! Parece que no hay posts.</p>
            @endif
        </div>
    </div>
    <script type="application/javascript">
        function show() {
            var element = document.getElementById("dropdown");
            element.classList.toggle('d-none');
        }
    </script>
@endsection
