<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Archivo;


class PostController extends Controller
{
    public function showForm() {
        return view("posts.formulario_crear_post");
    }

    public function createPost(Request $request) {

        $post = new Post();
        $post->title=$request->input("title");
        $post->private=$request->input("private")?1:0;
        $post->text=$request->input("description");
        $post->user_id=auth()->id();

        $post->save();

        $file = new Archivo();
        $file->name=$request->file("file")->getClientOriginalName();

        $file->path=$request->file("file")->store("public");
        $file->user_id=auth()->id();
        $file->post_id=$post->id;

        $file->save();
        return redirect()->route('home');
    }

    public function showFormEditar($id) {
        $detalle=evento::query()
            ->where('id', $id)
            ->first();
        return view("eventoForm",compact('detalle'));
    }

    public function deletePost($id)
    {
        $post = post::query()
            ->where('id', $id)
            ->first();
        $post->delete();
    }
}
