<div class="h5 mt-3 mb-4">Descubre</div>
    <ul class="text-left ml-4">
        @foreach($random_posts as $post)
            <li class="list-unstyled m-3"><a href="#">{{$post->title}}</a></li>
        @endforeach
    </ul>


