@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="row">
            @if(session('status') != null)
                <div class="col-12 alert-info rounded-right p-3">
                    <div >{{session('status')}}</div>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-lg-11 col-12 m-auto">
        <div class="card mt-5">
            <div class="card-body">
                <div class="card-title p-0 m-0">
            <div class="row border-bottom p-0 pb-3 pt-2 pl-2">
                <div class="col-1 mr-1">
                    @if($user->name == Auth::user()->name)
                        <button href="/edit_profile_picture"
                                onclick=" document.getElementById('profile-picture-input').click();"
                                style="border: 0; background: transparent;">
                            <img src="{{asset($user->profile_picture)}}" class="rounded-circle img-responsive" alt=""
                                 style="width: 3em;">
                        </button>
                        <form class="d-none" id="profile-picture-form" action="/edit_profile_picture" method="POST">
                            @csrf
                            <input id="profile-picture-input" type=file name="profile_picture">
                        </form>
                    @else
                        <div>
                            <img src="{{asset($user->profile_picture)}}" class="rounded-circle img-responsive" alt=""
                                 style="width: 3em;">
                        </div>
                    @endif
                </div>

                <div class="col-lg-4 col-6 text-papaya font-weight-bolder font-size-user">{{$user->name}}</div>

                @if($user->name == Auth::user()->name)
                    <div class="col-lg-2 col-5 text-marron">123 seguidores
                    </div>
                    <div class="col-lg-2 col-5 text-marron">123 seguidores</div>


                <div class="col-lg-2 col-1">
                    <div class="dropdown">
                        <div id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cog" onclick="show()"></i>
                        </div>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <button class="dropdown-item" type="button"><a class="text-marron" data-toggle="modal" data-target="#editarPerfilModal" href="#">Editar Perfil</a></button>
                            <button class="dropdown-item" type="button"><a class="text-marron"  data-toggle="modal" data-target="#cambiarContraseñaModal" href="#">Cambiar Contraseña</a></button>
                            <button class="dropdown-item" type="button"><a class="text-marron" href="#">Eliminar Cuenta</a></button>
                        </div>
                  </div>
                        @else
                            <div class="col-lg-3 col-3 m-auto">
                                <button type="button" class="btn hvr-ripple-out text-marron">Seguir</button>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-12 ml-4 pt-4 pb-4">{{$user->description}}</div>
                    </div>
                </div>

                    <div class="row">
                        <div class="col-3 offset-7 mt-3 d-none d-sm-block d-xs-block">
                            <div class="form-group has-search m-auto">
                                <span class="fa fa-search form-control-feedback"></span>
                                <input type="text" class="form-control" placeholder="Buscador">
                            </div>
                        </div>
                    </div>

                    <div class="row pt-5 pb-5">
                        @if(count($user->posts))
                            @foreach($user->posts as $post)
                                <div class="col-lg-3 col-6 col-md-3">
                                    <div class="fa-3x text-center">
                                        {!! $post->archivos->first()->icon !!}
                                    </div>
                                    <div class="text-center">{{$post->title}}</div>
                                </div>
                            @endforeach
                        @else
                            <p class="mt-5 ml-5" id="upsi">¡Ups! Parece que no hay posts.</p>
                        @endif
                    </div>

                    <div class="modal fade" id="editarPerfilModal" tabindex="-1" role="dialog"
                         aria-labelledby="editarPerfilModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form action="/user/update/{{$user->id}}" method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Email:</label>
                                            <input type="text" class="form-control" id="recipient-name" name="email"
                                                   placeholder="{{$user->email}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Descripción</label>
                                            <textarea class="form-control" id="message-text" name="description"
                                                      placeholder="{{$user->description}}"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Actualizar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>


        <div class="modal fade" id="cambiarContraseñaModal" tabindex="-1" role="dialog" aria-labelledby="cambiarContraseñaModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">

                        <form action="/user/update/password/{{$user->id}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="actual_password" class="col-form-label">Contraseña actual</label>
                                <input id="actual_password" type="password" class="form-control" name="actual_password" required>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-form-label">Nueva Contraseña</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new_password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="col-form-label">Nueva Contraseña</label>
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new_password">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="application/javascript">
    function show() {
        var element = document.getElementById("dropdown");
        element.classList.toggle('d-none');
    }
</script>

@endsection
