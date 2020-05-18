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
        <div id="carga-posts" class="mt-5 mb-3 col-7">
            <div class="row justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="application/javascript">

    var pagina = 2
    var peticion = false
    var carga = document.getElementById('carga-posts')

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
                        }else{
                            carga.classList.add('d-none')
                        }
                        pagina++
                        peticion = false
                })
                .catch(error => console.log(error))

            }
        }
</script>
@endsection

