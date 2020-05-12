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
        $posts = Post::all()->sortByDesc('created_at');
        return view("home", compact("posts"));
    }
}
