<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class postController extends Controller
{
    public function showForm() {
        return view("formulario_post");
    }

    public function createPost(Request $request)
    {
        $post = Post::Create($request->all());
        return $post;
    }
}
