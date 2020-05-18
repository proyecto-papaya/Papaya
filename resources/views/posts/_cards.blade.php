
    @if(count($posts))
        @foreach($posts as $post)
            <div class="card mt-3">
                <div class="card-body">
                    <div class="card-title row">
                        <div class="h3 p-2 col-10"><a class="text-papaya" href="/p/{{$post->id}}">{{$post->title}}</a></div>
                        <a href="/user/{{$post->user->id}}" class="col-1 d-flex justify-content-center align-items-center"><img src="{{$post->user->profile_picture}}" alt="" class="rounded-circle" style="height: 2em"></a>
                    </div>

                    <div class="card-text mb-3">{{$post->text}}</div>
                    <div class="card-text row justify-content-between">
                        <div class="ml-1 col-11 row">
                            {!! $post->archivos->first()->icon !!}
                            <div class="h6 col-6">{{$post->date()}}</div>
                        </div>
                        <i class="far fa-heart col-1"></i>

                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p class="mt-5 ml-5" id="upsi" >¡Ups! Parece que no hay posts.</p>
    @endif

