<?php


namespace App\Http\Controllers;

use App\Lista;
use Illuminate\Http\Request;
use App\Post;
use App\Archivo;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ListasController extends Controller
{

    public function createFavorite($postId)
    {
        $user_id = Auth::user()->id;
        $activeHeart = false;
        $lista = Lista::where('user_id','=', $user_id)->firstOrFail();
        $post=Post::query()
            ->where('id', $postId)
            ->first();

        if (Auth::user()->isFavorite($post->id)){
            $lista->posts()->detach($postId);
            $activeHeart = false;

        } else{
            $lista->posts()->attach($postId);
            $activeHeart = true;
        }

        return response()->json(['status' => 'success', 'activeHeart' => $activeHeart]);

    }


    public function listaFavoritos(){
        $user_id = Auth::user()->id;

        $favs = DB::select('select distinct post.*, arch.icon
                        from listas list
                        inner join lista_post listp on list.id = listp.lista_id
                        inner join posts post on listp.post_id = post.id
                        inner join archivos arch on arch.post_id = post.id
                        where list.user_id = ?',[$user_id]);

      //  return view("layouts.app", compact("favs"));
        return compact("favs");

        return view('', compact("favs"));
    }

}
