@extends('layouts.app')

@section('content')
    <div class="col-md-8 m-auto pt-4">
        <div class="card pt-4 px-4 pb-5">
            <div class="row">
                <div class="col-lg-10 col-8 h1 text-papaya">
                    {{$post->title}}
                </div>
                <div class="row">
                    <div class="col-12">
                        {{$post->number_downloads}} descargas
                    </div>
                    @if($post->user->name == Auth::user()->name)
                        <div class="col-12">
                            @if($post->private)
                                Privado
                            @else
                                Público
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <a href="/user/{{$post->user->id}}"><img src="{{ asset('images/user.png') }}" alt="" class="rounded-circle ml-3" style="width: 2em"></a>
                <div class="text-dark ml-3">{{$post->user->name}}</div>
            </div>

            <div class="row mt-3 mb-3">
                <div class="col-11">
                    @if( $post->archivos->first() != null)
                        @if( $post->archivos->first()->type  == "image")
                            <img class="img-fluid mt-2 ml-5 mb-3" style="max-width: 90%" src="{{Storage::url($post->archivos->first()->path)}}">
                        @elseif( $post->archivos->first()->type  == "audio")
                            <audio id= "audioId" controls="controls" class="embed-responsive embed-responsive-16by9 mt-4" src="{{Storage::url($post->archivos->first()->path)}}" type="audio/mp3">
                            </audio>
                        @elseif( $post->archivos->first()->type  == "video")
                            <video controls="controls" class="embed-responsive embed-responsive-16by9 m-auto pb-4 pt-3" src="{{Storage::url($post->archivos->first()->path)}}" style="max-width: 95%">
                            </video>
                        @elseif( $post->archivos->first()->type  == "text")
                            <embed src="{{Storage::url($post->archivos->first()->path)}}" class="mt-4 ml-3 mb-4" type="application/pdf" width="100%" height="600px" />
                        @elseif( $post->archivos->first()->type  == "text")
                            <embed src="{{Storage::url($post->archivos->first()->path)}}" type="application/text" width="100%" height="600px" />
                        @endif
                    @else
                        <img src="{{ asset('images/logo_sin_letras.png') }}" alt="" style="height: 20em" class="mx-auto d-block">
                    @endif
                </div>
                <div class="col-12 col-lg-1 ml-lg-0 ml-4">
                    @if($post->user->name == Auth::user()->name)
                        <div class="dropdown">
                            <div id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h" onclick="show()"></i>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <button class="dropdown-item" type="button"><a class="text-marron" href="/download/{{$post->archivos->first()->id}}">Descargar</a></button>
                                <button class="dropdown-item" type="button"><a class="text-marron" href="/formPostEditar{{$post->id}}">Editar</a></button>
                                <button class="dropdown-item" type="button"><a class="text-marron" href="/deletePost{{$post->id}}">Eliminar</a></button>


                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if($post->user->name != Auth::user()->name)
                <div class="row justify-content-center">
                    <button class="btn btn-papaya col-7 col-lg-6 mb-4" type="button" href="/download/{{$post->archivos->first()->id}}">DESCARGAR</button>
                </div>
            @endif

            <div class="row">
                <div class="col-11 m-auto text-justify">
                    {{$post->text}}
                </div>
            </div>

            <div class="row  mt-5">
                <form class="form-horizontal col-12" method="post" action="/comment/{{$post->id}}" enctype="multipart/form-data">
                    @csrf
                    <label class="mr-3 mb-3" for="comment">
                        @if($post->user->profile_picture)
                            <img src="{{$post->user->profile_picture}}" alt="" class="rounded-circle col-1">
                        @else
                            <img src="{{ asset('images/user.png') }}" alt="" class="rounded-circle ml-2 text-marron" style="width: 2em">
                        @endif
                    </label>
                    <textarea class="col-lg-8 col-9 md-textarea comment" id="comment" name="text" rows="3" cols="30" required placeholder="Haz un comentario"></textarea>
                    <button class="col-lg-2 btn m-auto m-md-auto" type="submit">COMENTA</button>
                </form>
            </div>

            @if(count($comments))
                @foreach($comments as $comment)
                    @include('posts._comment')
                @endforeach
            @endif

        </div>

        <script type="application/javascript">
            function show() {
                var element = document.getElementById("dropdown");
                element.classList.toggle('d-none');
            }
        </script>
    </div>
@endsection
