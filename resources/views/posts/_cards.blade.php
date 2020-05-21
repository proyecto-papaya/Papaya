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

                    <a href="/lists/{{$post->id}}">
                     <i class="far fa-heart col-1">
                     </i></a>
                </div>
            </div>
        </div>
    @endforeach
@else
    <p class="mt-5 ml-5" id="upsi">¡Ups! Parece que no hay posts.</p>
@endif
