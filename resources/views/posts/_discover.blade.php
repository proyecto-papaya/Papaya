<h5>Descubre</h5>
<ul>
    @foreach($random_posts as $post)
        <li>{{$post->title}}</li>
    @endforeach
</ul>
