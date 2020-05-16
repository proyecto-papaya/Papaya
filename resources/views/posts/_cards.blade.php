
    @if(count($posts))
        @foreach($posts as $post)
            <div class="card mt-3">
                <div class="card-body">
                    <div class="card-title justify-content-around">
                        <div class="h3 p-2"><a class="text-papaya" href="/p/{{$post->id}}">{{$post->title}}</a></div>
                        <a href="#"><img src="{{$post->user->profile_picture}}" alt="" class="rounded-circle"></a>
                    </div>

                    <div class="card-text mb-3">{{$post->text}}</div>
                    <div class="card-text row justify-content-between">
                        <div class="col-11 row">
                            <i class="fas fa-file-pdf col-1"></i>
                            <div class="h6 col-6">{{$post->date()}}</div>
                        </div>
                        <i class="far fa-heart col-1"></i>

                    </div>
                </div>
            </div>
        @endforeach
        <div class="loading"></div>
    @else
        <p class="mt-5 ml-5">¡Ups! Parece que no hay posts.</p>
    @endif

