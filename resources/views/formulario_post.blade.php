@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 600px; margin: auto;">
    <form name="formulario_post" id="formulario_post" action='createPost' method="post" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="descripcion">Titulo</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value='' >
            </div>
            <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="6"></textarea>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="privado" name="privado">
                        <label class="form-check-label" for="privado">Privado</label>
                    </div>
                </div>
                <div class="col-6">
                    <label><i class="fas fa-file-upload fa-3x" style="color:#000000;"></i></label>
                </div>
            </div>
                    <input type="file" class="form-control-file" id="archivo" value='' name="archivo">
            <button type="submit" class="btn btn-success btn-block font-weight-bolder ">Subir</button>
    </form>
</div>
@endsection

