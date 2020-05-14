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

    public function showHome(){
        //paginate() sólo se puede usar sobre una query, no una Collection
        $posts = Post::paginate(4)->sortByDesc('created_at');

        return view("home", compact("posts"));
    }

    public function paginacion(){
        //paginate() sólo se puede usar sobre una query, no una Collection
        $posts = Post::paginate(4)->sortByDesc('created_at');

        return view("posts._cards", compact("posts"));
    }
}
