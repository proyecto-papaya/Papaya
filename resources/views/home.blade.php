@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-2">
        <div id="posts" class="col-md-12 col-xl-8" style="margin-right: 15em">
            @include("posts._cards")
        </div>
        <div class="col-md-3 position-fixed" style="margin-left: 50em">
            <div class="jumbotron">
                @include("posts._discover")
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">

    window.onscroll = ()=>{
        let pagina = 2

        if((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight){

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

