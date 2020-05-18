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

            <div class="col-3">123 seguidores</div>
            <div class="col-3">123 siguiendo</div

            <div class="col-3">
            @if($user->name == Auth::user()->name)
                    <button type="button" style="border: 0; background: transparent;"><i class="fas fa-cog"></i></button>
            @else
                    <button type="button" class="btn btn-outline-dark">Seguir</button>
            @endif
            </div>
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

    </div>
@endsection
