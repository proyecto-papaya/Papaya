<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function showForm() {
        return view("formulario_post");
    }

    public function showHome(){
        //paginate() sólo se puede usar sobre una query, no una Collection
        $posts = Post::paginate(6)->sortByDesc('created_at');

        return view("home", compact("posts"));
    }
}
