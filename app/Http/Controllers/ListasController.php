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
        $lista->posts()->attach($postId);

        return redirect()->route('home');
    }


}
