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
        $lista = Lista::where('user_id','=', $user_id)->firstOrFail();
        $post=Post::query()
            ->where('id', $postId)
            ->first();

        if ($post->favorite){
            $lista->posts()->detach($postId);
            $post->update(['favorite' => false]);
        } else{
            $lista->posts()->attach($postId);
            $post->update(['favorite' => true]);
        }

        return redirect()->route('home');
    }


    public function listaFavoritos(){
        $user_id = Auth::user()->id;
        $postsFavoritos = Lista::where('user_id', '=', $user_id and '');
    }

}
