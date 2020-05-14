@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div id="posts" class="col-md-8">
            @include("posts._cards")
        </div>
        <div class="col-md-2">
            AQUI VAN LAS SUGERENCIAS.
            Deberían ser position absolute o algo para que no se muevan con el scroll.
        </div>
    </div>
</div>

<script type="application/javascript">

    window.onscroll = ()=>{
        let pagina = 2

        if((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight){

            console.log("FUNCIONA")

            fetch(`/pages?page=${pagina}`, {
                method: 'get'
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById('posts').innerHTML += html
            })
            .catch(error=> console.log(error))
        }
    }

</script>
@endsection

