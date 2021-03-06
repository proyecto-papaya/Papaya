<div class="row mt-2">
    <div class="col-1">
        @if(Auth::user()->profile_picture == 'images/user.png')
            <a href="/user/{{Auth::user()->id}}"><img src="{{ asset('images/user.png') }}" alt="" class="rounded-circle ml-3" style="width: 2em"></a>
        @else
            <a href="/user/{{Auth::user()->id}}"><img src="{{Storage::url(Auth::user()->profile_picture)}}" alt="" class="rounded-circle ml-3" style="width: 2em"></a>
        @endif
    </div>
    <div class="col-lg-9 col-9">
        <div class="text-dark">
            {{$comment->text}}
        </div>
    </div>
</div>
