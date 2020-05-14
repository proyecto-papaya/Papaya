@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 600px; margin: auto;">
        <form name="formulario_post" id="formulario_post" action='updatePost{{$post->id}}' method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Titulo</label>
                <input type="text" class="form-control" id="title" name="title" value={{$post->title}} >
            </div>
            <div class="form-group">
                <label for="description">Descripcion</label>
                <textarea class="form-control" id="description" name="description" rows="6">{{$post->text}}</textarea>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="private" name="private" {{$post->private==1?"checked":""}}>
                        <label class="form-check-label" for="private">Privado</label>
                    </div>
                </div>
                {{--                <div class="col-6">--}}
                {{--                    <label><i class="fas fa-file-upload fa-3x" style="color:#000000;"></i></label>--}}
                {{--                </div>--}}
            </div>
            <div class="for-group my-3">
                @if(isset($file))
                    <label for="file">Cambiar el archivo: {{$file->name}}</label>
                @endif
                <input type="file" class="form-control-file" id="file" value='' name="file">
            </div>

            <button type="submit" style="background-color:#f67f21" class="btn btn-block font-weight-bolder ">Actualizar</button>
        </form>
    </div>
@endsection

