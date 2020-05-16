<div class="row mt-2">
    <div class="col-1">
        @if($post->user->profile_picture)
            <img src="{{$post->user->profile_picture}}" alt="" class="rounded-circle col-1">
        @else
            <img src="{{ asset('images/user.png') }}" alt="" class="rounded-circle ml-2" style="width: 2em">
        @endif
    </div>
    <div class="col-9">
        <div class="text-dark">
            {{$comment->text}}
        </div>
    </div>
</div>
