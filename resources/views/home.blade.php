@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mt-2">
        <div id="posts" class="col-12 col-lg-8 mr-0 mr-sm-5">
            @include("posts._cards")
        </div>
        <div class="col-lg-3 d-none d-lg-block border text-center h-75 descubre">
            @include("posts._discover")
        </div>
    </div>
</div>


<script type="application/javascript">

    var pagina = 2
    var peticion = false

    window.onscroll = () => {
        if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight - 1) {
            if(!peticion){
                peticion = true

                fetch(`/pages?page=${pagina}`, {
                    method: 'get'
                })
                .then(response => response.text())
                .then(html => {
                        if (document.getElementById('upsi') == null) {
                            document.getElementById('posts').innerHTML += html
                        }
                        pagina++
                        peticion = false
                })
                .catch(error => console.log(error))

            }
        }

    }

</script>
@endsection

