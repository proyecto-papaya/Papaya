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

        $post = new Post();
        $post->title=$request->input("title");
        $post->private=$request->input("private")?1:0;
        $post->text=$request->input("description");
        $post->user_id=auth()->id();

        $post->save();
        if(isset($request->file)){
            $file = new Archivo();
            $file->name=$request->file("file")->getClientOriginalName();

            $file->path=$request->file("file")->store("public");
            $file->user_id=auth()->id();
            $file->post_id=$post->id;

            $file->save();
        }

        return redirect()->route('home');
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
            $file->path=$request->file("file")->store("public");

            $file->save();
        }

        return redirect()->route('home');

    }
}
