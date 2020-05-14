@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-2">
        <div id="posts" class="col-12 col-lg-8 mr-0 mr-sm-5 mr-lg-15">
            @include("posts._cards")
        </div>
        <div class="col-lg-3 d-none d-lg-block position-fixed" style="margin-left: 40%">
            <div class="border border-dark text-center w-75">
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

