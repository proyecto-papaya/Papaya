
    @if(count($posts))
        @foreach($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="card-title justify-content-around">
                        <div class="h3 p-2">{{$post->title}} </div>
                        <img src="{{$post->user->profile_picture}}" alt="" class="rounded-circle">
                    </div>

                    <div class="card-text">{{$post->text}}</div>
                    <div class="card-text row justify-content-between">
                        <div class="col-11">
                            <img src="#" alt="" class="col-1">
                            <div class="h6 col-3">{{$post->date()}}</div>
                        </div>
                        <i class="far fa-heart col mt-4"></i>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="loading"></div>
    @else
        <p>Todavía no hay ningún post.</p>
    @endif

