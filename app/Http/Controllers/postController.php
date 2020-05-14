<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Archivo;
use Illuminate\Support\Facades\DB;

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

<<<<<<< HEAD
    public function deletePost($id){

        $post = post::query()
            ->where('id', $id)
            ->first();

        $post->delete();

      //  return redirect()->route('home');
=======
    public function showHome(){
        //paginate() sólo se puede usar sobre una query, no una Collection
        $posts = Post::paginate(3)->sortByDesc('created_at');

        $random_posts = DB::table('posts')
                        ->inRandomOrder()
                        ->take(10)
                        ->get();

        return view("home", compact("posts","random_posts"));
    }

    public function paginacion(){
        //paginate() sólo se puede usar sobre una query, no una Collection
        $posts = Post::paginate(3)->sortByDesc('created_at');

        return view("posts._cards", compact("posts"));
>>>>>>> 42822007fec7f00908e61f38711d6c26a122c72a
    }
}
