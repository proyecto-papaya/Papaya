@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 600px; margin: auto;">
    <form name="formulario_post" id="formulario_post" action='createPost' method="post" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="title">Titulo</label>
                <input type="text" class="form-control" id="title" name="title" value='' >
            </div>
            <div class="form-group">
                <label for="description">Descripcion</label>
                <textarea class="form-control" id="description" name="description" rows="6"></textarea>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="private" name="private">
                        <label class="form-check-label" for="private">Privado</label>
                    </div>
                </div>


                <div class="form-group text-center">
                        <label for="file" >
                            <i class="fas fa-file-upload fa-3x" style="color: #f67f21"></i>
                        </label>
                        <input onchange="cambiar();" class="d-none" required id="file" type=file name="file">
                        <br><small>Seleccionar archivo</small>
                        <div id="info"></div>
                </div>
            </div>
            <button type="submit" class="btn btn-block btn-papaya font-weight-bolder ">Subir</button>
    </form>
</div>
<script type="application/javascript">
    function cambiar(){
        var pdrs = document.getElementById('file').files[0].name;
        document.getElementById('info').innerHTML = pdrs;
    }
</script>
@endsection

