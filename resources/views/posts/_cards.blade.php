@if(count($posts))
    @foreach($posts as $post)
        <div class="card margen-adecuado">
            <div class="card-body">
                <div class="card-title row">
                    <div class="h3 p-2 col-10"><a class="text-papaya" href="/p/{{$post->id}}">{{$post->title}}</a></div>
                    @if($post->user->profile_picture == 'images/user.png')
                        <a href="/user/{{$post->user->id}}" class="col-1 d-flex justify-content-center align-items-center"><img src="{{ asset('images/user.png') }}" alt="" class="rounded-circle" style="height: 2em"></a>
                    @else
                        <a href="/user/{{$post->user->id}}" class="col-1 d-flex justify-content-center align-items-center"><img src="{{Storage::url($post->user->profile_picture)}}" alt="" class="rounded-circle" style="height: 2em"></a>
                    @endif

                </div>

                <div class="card-text mb-3">{{$post->text}}</div>
                <div class="card-text row justify-content-between">
                    <div class="ml-1 col-11 row">
                        {!! $post->archivos->first()->icon !!}
                        <div class="h6 col-6">{{$post->date()}}</div>
                    </div>
                  <a class="heart-papaya text-dark cursor" onclick="favClick({{$post->id}})">
                    @if(Auth::user()->isFavorite($post->id))
                            <i id="heart{{$post->id}}" class="fas fa-heart col-1"></i>
                        @else
                            <i id="heart{{$post->id}}" class="far fa-heart col-1">
                            </i>
                        @endif
                     </a>
                </div>
            </div>
        </div>
    @endforeach
@else
    <p class="mt-5 ml-5" id="upsi">¡Ups! Parece que no hay posts.</p>
@endif

<script>

    function favClick(id){
        $.ajax({
                url: '/lists/'+id,
                type: 'get',
                success:function (data) {
                    if(data.activeHeart){
                        const activeHeart = $('#heart'+id).addClass('fas')
                        activeHeart.removeClass('far')
                    }
                    else{
                        const activeHeart = $('#heart'+id).addClass('far')
                        activeHeart.removeClass('fas')
                    }
                },
                error: function (data) {
                    console.log('Ha salido mal.')
                }
            })
    }

</script>
