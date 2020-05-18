<div class="h5 mt-4 mb-4 descubreTop ">Descubre</div>
    <ul class="text-left ml-4">
        @foreach($random_posts as $post)
            <li class="list-unstyled m-3"><a class="text-marron" href="/p/{{$post->id}}">{{$post->title}}</a></li>
        @endforeach
    </ul>


