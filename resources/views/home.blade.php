@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($posts as $post)
                <div class="card">

                </div>
            @endforeach
        </div>
        <div class="col-md-2">
            AQUI VAN LAS SUGERENCIAS.
            Deberían ser position absolute o algo para que no se muevan con el scroll.
        </div>
    </div>
</div>
@endsection
