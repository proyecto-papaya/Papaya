@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div id="posts" class="col-md-8">
            @if(count($posts))
                @foreach($posts as $post)
                    <div class="card">
                        <div class="card-title">{{$post->title}}</div>
                    </div>
                @endforeach
            <div class="loading"></div>
            @else
                <p>Todavía no hay ningún post.</p>
            @endif
        </div>
        <div class="col-md-2">
            AQUI VAN LAS SUGERENCIAS.
            Deberían ser position absolute o algo para que no se muevan con el scroll.
        </div>
    </div>
</div>

<script>
    $('#posts').infinitescroll({
        navSelector  : "ul.pagination",
        nextSelector : "ul.pagination li:last-child a",
        itemSelector : "#posts div.item",
        loading: {
            finished: undefined,
            finishedMsg: "No se encontraron mas posts para mostrar",
            img: {{ asset('images/loading.gif') }},
            msg: null,
            msgText: "Cargando...",
            selector: ".loading",
            speed: 'fast',
            start: undefined
        }});
</script>

@endsection
