@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-9 h1">
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
            <img src="{{ asset('images/user.png') }}" alt="" class="rounded-circle ml-2" style="width: 2em">
            <div class="text-dark ml-3">{{$post->user->name}}</div>
        </div>

        <div class="row mt-3 mb-3">
            <div class="col-11">
                @if( $post->archivos->first() != null)
                    <img src="{{Storage::url($post->archivos->first()->path)}}">
                @else
                    <img src="{{ asset('images/logo_sin_letras.png') }}" alt="" style="height: 20em" class="mx-auto d-block">
                @endif
            </div>
            @if($post->user->name == Auth::user()->name)
                <div class="col-1">
                    <i class="fas fa-ellipsis-h" onclick="show()"></i>
                    <ul id="dropdown" class="d-none">
                        <li class="list-unstyled"><a href="/download/{{$post->archivos->first()->id}}">Descargar</a></li>
                        <li class="list-unstyled">Editar</li>
                        <li class="list-unstyled">Eliminar</li>
                    </ul>
                </div>
            @endif
        </div>

        @if($post->user->name != Auth::user()->name)
            <div class="row justify-content-center">
                <button class="btn btn-dark col-6" type="button" href="/download/{{$post->archivos->first()->id}}">DESCARGAR</button>
            </div>
        @endif

        <div class="row">
            <div class="text-justify mt-5">
                {{$post->text}}
            </div>
        </div>

<<<<<<< HEAD
        <div class="row mt-5">
            @if(count($comments))
                @foreach($comments as $comment)
                    @include('posts._comment')
                @endforeach
            @endif
        </div>
        <div class="row">
            <form class="form-horizontal" method="post" action="/comment" enctype="multipart/form-data">
=======
        <div class="row  mt-5">
            <form class="form-horizontal col-12" method="post" action="/comment/{{$post->id}}" enctype="multipart/form-data">
>>>>>>> bc2bbae... Mejorar estilo comentarios
                @csrf
                <label class="mr-3 mb-3" for="comment">
                    @if($post->user->profile_picture)
                        <img src="{{$post->user->profile_picture}}" alt="" class="rounded-circle col-1">
                    @else
                        <img src="{{ asset('images/user.png') }}" alt="" class="rounded-circle ml-2" style="width: 2em">
                    @endif
                </label>
<<<<<<< HEAD
                <textarea class="col-8 h-25 rounded-top" name="comment" id="comment" cols="30" rows="10" required placeholder="Haz un comentario"></textarea>
                <button class="col-3 btn btn-dark" type="submit">COMENTA</button>
=======
                <textarea class="col-8 rounded-top" name="text" id="comment" cols="30" rows="10" required placeholder="Haz un comentario" style="height: 2em"></textarea>
                <button class="col-2 btn" type="submit">COMENTA</button>

>>>>>>> bc2bbae... Mejorar estilo comentarios
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
@endsection
