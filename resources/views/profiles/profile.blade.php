@extends('layouts.app')
@section('content')
    <div class="container m-0 p-0 m-sm-auto">
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
        <div class="col-lg-11 col-12 m-md-auto m-0 p-0">
            <div class="card mt-md-5">
                <div class="card-header border-bottom-0 p-0 m-0">
                    <div class="card-title mt-md-5 mt-3 p-0 m-0 col-md-10">
                        <div class="row pt-2 p-0 m-0">
                            <div class="col-md-7 col-3 pr-0">
                                <div class="row">
                                    <div class="col-md-4 text-md-right text-center" >
                                        @if($user->name == Auth::user()->name)
                                            @if($user->profile_picture == 'images/user.png')
                                                <img  src="{{ asset('images/user.png') }}" alt="" class="rounded-circle img-responsive w-100" onclick="updateAvatar()"style="width: 3em">
                                            @else
                                                <img  src="{{Storage::url($user->profile_picture)}}" class="rounded-circle img-responsive w-100" onclick="updateAvatar()" alt=""
                                                     style="width: 3em;">
                                            @endif
                                            <form class="d-none" id="profile-picture-form" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input id="profile-picture-input" type=file name="profile_picture">
                                            </form>
                                        @else
                                            <div class="">
                                                @if($user->profile_picture == 'images/user.png')
                                                    <img src="{{ asset('images/user.png') }}" alt="" class="rounded-circle img-responsive w-100" style="width: 3em">
                                                @else
                                                    <img src="{{Storage::url($user->profile_picture)}}" class="rounded-circle img-responsive w-100"  alt=""
                                                         style="width: 3em;">
                                                @endif
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-11 col-md-8 text-papaya font-weight-bolder text-md-left text-center"><label>{{$user->name}}</label></div>
                                </div>
                            </div>
                            @if($user->name == Auth::user()->name)
                                <div class="col-md-1 col-3 order-md-10 text-md-right text-left pl-0">
                                    <div class="dropdown">
                                        <div id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-cog" onclick="show()"></i>
                                        </div>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                            <button class="dropdown-item" type="button"><a class="text-marron" data-toggle="modal" data-target="#editarPerfilModal" href="#">Editar Perfil</a></button>
                                            <button class="dropdown-item" type="button"><a class="text-marron"  data-toggle="modal" data-target="#cambiarContraseñaModal" href="#">Cambiar Contraseña</a></button>
                                            <button class="dropdown-item" type="button"><a class="text-marron" data-toggle="modal" data-target="#eliminarPerfilModal" href="#">Eliminar Cuenta</a></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-3 text-right mr-md-0 pr-md-0">
                                    <button class="text-marron text-center bg-transparent border-0 font-weight-bolder" data-toggle="modal" data-target="#seguidoresModal" >
                                        Seguidores
                                    </button>
                                </div>
                                <div class="col-md-2 col-3 text-right mr-md-0 pr-md-0">
                                    <button class="text-marron text-center bg-transparent border-0 font-weight-bolder" data-toggle="modal" data-target="#seguidosModal" >
                                        Seguidos
                                    </button>
                                </div>
                                    @else

                                <div class="dropdown col-md-1 offset-md-3 offset-5 col-3 order-md-10">
                                        <div class="" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <button type="button" id="followButton" onclick='{{Auth::user()->isFollowing($user->id)?"show2()":"follow()"}}' class="btn hvr-ripple-out text-marron">
                                                {{Auth::user()->isFollowing($user->id)?"Siguiendo":"Seguir"}}
                                            </button>
                                        </div>

                                    <div id="unFollowButton"class="dropdown-menu position-absolute" style="top:0" aria-labelledby="dropdownMenu2">
                                        <button class="dropdown-item text-marron"  onclick="unFollow()" type="button"><lavel>Dejar de seguir</lavel></button>
                                        </div>
                                </div>
                            @endif
                            </div>
                            <div class="row mr-0 ml-md-5 ml-2">
                                <div class="col-10 pt-4 pb-4"><label>{{$user->description}}</label></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-10">
                                <div class="row justify-content-end d-flex">
                                    <div class="col-sm-6 col-md-4 form-group has-search mt-3 d-none d-sm-block d-xs-block">
                                        <form id="formBuscarInProfile"  method="get" >
                                            <span class="fa fa-search form-control-feedback"></span>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="buscador" name="buscador" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                <div class="input-group-append">
                                                    <button class="btn btn-papaya" type="submit"><b>Buscar</b></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row pt-5 pb-5">
                            @if(count($user->posts))

                                @if(isset(Request()->buscador))
                                    @foreach($user->posts as $post)
                                        @if(strpos($post->title, Request()->buscador) !== false)
                                        <div class="col-6 col-md-3">
                                            <div class="fa-3x text-center">
                                                {!! $post->archivos->first()->icon !!}
                                            </div>
                                            <div class="text-center text-dark"><a class="text-dark" href="/p/{{ $post->id }}">{{$post->title}}</a></div>
                                        </div>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach($user->posts as $post)
                                        @if(Auth::user()->id == $user->id)
                                            <div class="col-lg-3 col-6 col-md-3">
                                                <div class="fa-3x text-center">
                                                    {!! $post->archivos->first()->icon !!}
                                                </div>
                                                <div class="text-center"><a class="text-dark" href="/p/{{ $post->id }}">{{$post->title}}</a></div>
                                            </div>


                                        @elseif(!$post->private)
                                            <div class="col-lg-3 col-6 col-md-3">
                                                <div class="fa-3x text-center">
                                                    {!! $post->archivos->first()->icon !!}
                                                </div>
                                                <div class="text-center">{{$post->title}}</div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
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
                                                <button type="submit" class="btn btn-papaya">Actualizar</button>
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
                                    <button type="submit" class="btn btn-papaya">Actualizar</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>


        <div class="modal fade" id="eliminarPerfilModal" tabindex="-1" role="dialog" aria-labelledby="eliminarPerfilModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">

                        <form action="/user/delete" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')

                            <div class="col-12">
                                <p>¿Estás segurx de que quieres borrar la cuenta?</p>
                                <p>Los cambios serán irreversibles.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-papaya">Eliminar mi cuenta</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="seguidoresModal" tabindex="-1" role="dialog" aria-labelledby="seguidoresModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Seguidores</h5>
                    </div>
                    <div class="modal-body">
                        @foreach($user->followers()->get() as $follower)
                            <div class="row px-5" id="follower{{$follower->id}}">
                                <div class="col-3">
                                            @if($follower->profile_picture == 'images/user.png')
                                                <img src="{{ asset('images/user.png') }}" alt="" class="rounded-circle img-responsive w-100" >
                                            @else
                                                <img src="{{Storage::url($follower->profile_picture)}}" class="rounded-circle img-responsive w-100"  alt="">
                                            @endif
                                </div>
                                <div class="col-6"><h5>{{$follower->name}}</h5></div>
                                <div class="col-3">
                                    <button onclick='deleteFollower({{$follower->id}})' class="btn btn-papaya">Eliminar</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="seguidosModal" tabindex="-1" role="dialog" aria-labelledby="seguidosModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Seguidos</h5>
                    </div>
                    <div class="modal-body">
                        @foreach($user->followeds()->get() as $followed)
                            <div class="row px-5" id="followed{{$followed->id}}">
                                <div class="col-3">
                                    @if($followed->profile_picture == 'images/user.png')
                                        <img src="{{ asset('images/user.png') }}" alt="" class="rounded-circle img-responsive w-100" >
                                    @else
                                        <img src="{{Storage::url($followed->profile_picture)}}" class="rounded-circle img-responsive w-100"  alt="">
                                    @endif
                                </div>
                                <div class="col-6"><h5>{{$followed->name}}</h5></div>
                                <div class="col-3">
                                    <button  class="btn btn-papaya" onclick='deleteFollowed({{$followed->id}})'>Eliminar</button>
                                </div>
                            </div>
                        @endforeach
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

    function updateAvatar() {
        const csrfToken = "{{ csrf_token() }}"
        const input = document.getElementById('profile-picture-input')

        input.click();
        input.onchange = function(){

            let photo = document.getElementById("profile-picture-input").files[0];
            let formData = new FormData();

            formData.append("profile_picture", photo)

            fetch('/user/picture/update/' + {{Auth::user()->id}}, {
                method: "POST",
                headers: {
                    "X-CSRF-Token": csrfToken,
                },
                body: formData
            }).then(response => {
                if (!response.ok) {
                    throw response;
                }
                location.reload()
                return response
            }).then((data) => {
                console.log(data)
            }).catch(error => {
                console.error("error", error)
            })

        }
    }
</script>
    <script type="application/javascript">
        document.getElementById("formBuscarInProfile").addEventListener("keypress", submit(e));
        function submit(e) {
            if(e.which == 10 || e.which == 13) {
                this.form.submit();
            }}
    </script>
    <script>
        function follow() {
            fetch(`/follow{{$user->id}}`, {
                method: 'get'
            }).then(response => response.text())
                .catch(error => console.log(error))
            document.getElementById("followButton").innerHTML="Siguiendo"
            document.getElementById("followButton").setAttribute('onclick','show2()')
            $('#unFollowButton').addClass("d-none");
        }

        function unFollow() {
            fetch(`/unFollow{{$user->id}}`, {
                method: 'get'
            }).then(response => response.text())
                .catch(error => console.log(error))
            document.getElementById("followButton").innerHTML="Seguir"
            document.getElementById("followButton").setAttribute('onclick','follow()')
        }

        function deleteFollower(id) {
            fetch('/deleteFollower'+id, {
                method: 'get'
            }).then(response => response.text())
                .catch(error => console.log(error))
            $('#follower'+id).addClass("d-none");
        }

        function deleteFollowed(id) {
            fetch(`/deleteFollowed`+id, {
                method: 'get'
            }).then(response => response.text())
                .catch(error => console.log(error))

            $('#followed'+id).addClass("d-none");
        }

        function show2(){
            $('#unFollowButton').removeClass("d-none");
            $('#dropdownMenu2').addClass("show");
        }
    </script>

@endsection
