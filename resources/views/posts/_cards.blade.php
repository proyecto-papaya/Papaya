
    @if(count($posts))
        @foreach($posts as $post)
            <div class="card p-5">
                <div class="card-title">{{$post->title}}</div>
            </div>
        @endforeach
        <div class="loading"></div>
    @else
        <p>Todavía no hay ningún post.</p>
    @endif

