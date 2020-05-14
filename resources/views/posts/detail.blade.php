@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-9 h1">
            {{$post->title}}
    </div>
        <div class="row">
            <div class="col-12">
                Descargado {{$post->number_downloads}} veces
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
        <div class="text-dark ml-3">user</div>
    </div>

    <div class="row mt-5">
        <div class="col-11">
            ARCHIVO
        </div>
        <div class="col-1">
            <i class="fas fa-ellipsis-h" onclick="show()"></i>
                <ul id="dropdown" class="d-none">
                    <li class="list-unstyled">Descargar</li>
                    <li class="list-unstyled">Editar</li>
                    <li class="list-unstyled">Eliminar</li>
                </ul>
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
