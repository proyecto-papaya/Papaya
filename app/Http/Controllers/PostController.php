<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Archivo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function showForm() {
        return view("posts.formulario_crear_post");
    }

    public function createPost(Request $request) {
        if(isset($request->file)){

            $post = new Post();
            $post->title=$request->input("title");
            $post->private=$request->input("private")?1:0;
            $post->text=$request->input("description");
            $post->user_id=auth()->id();

            $post->save();

            $file = new Archivo();
            $file->name=$request->file("file")->getClientOriginalName();

            $file->type = $file->archivo_type();
            $file->icon = $file->icon();

            $file->path=$request->file("file")->store("public");
            $file->user_id=auth()->id();
            $file->post_id=$post->id;

            $file->save();
        }
        return redirect()->route('home');
    }

    /**
     * Recibe un id y devuelve un objeto con el Post que tenga ese id
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDetail($id)
    {
        $post = Post::findOrFail($id);
        $comments = $post->comentarios;

        return view("posts.detail", compact("post","comments"));
    }

    public function showFormEditar($id) {
        $post=Post::query()
            ->where('id', $id)
            ->first();
        $file=Archivo::query()
            ->where('post_id', $id)
            ->first();
        return view("posts.formulario_editar_post",compact('post'),compact('file'));
    }

    public function deletePost($id)
    {
        $post = post::query()
            ->where('id', $id)
            ->first();
        $post->delete();
        return redirect()->route('home');
    }

    public function updatePost($id,Request $request) {
        $post=Post::query()
            ->where('id', $id)
            ->first();
        $post->title=$request->input("title");
        $post->private=$request->input("private")?1:0;
        $post->text=$request->input("description");

        $post->save();
        if(isset($request->file)){
            $file = Archivo::query()
                ->where('post_id', $id)
                ->first();
            if(isset($file)){
                Storage::delete($file->path);
            }else{
                $file = new Archivo();
                $file->user_id=auth()->id();
                $file->post_id=$post->id;
            }

            $file->name=$request->file("file")->getClientOriginalName();
            $file->type = $file->archivo_type();
            $file->icon = $file->icon();
            $file->path=$request->file("file")->store("public");

            $file->save();
        }

        return redirect()->route('home');
    }
}
