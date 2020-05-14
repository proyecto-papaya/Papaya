<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Archivo;


class postController extends Controller
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


    /**
     * Recibe un id y devuelve un objeto con el Post que tenga ese id
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDetail($id){
        $post = Post::findOrFail($id);
        return view("posts.detail", compact("post"));
    }

    public function deletePost($id)
    {
        $post = post::query()
            ->where('id', $id)
            ->first();
        $post->delete();
    }
}
