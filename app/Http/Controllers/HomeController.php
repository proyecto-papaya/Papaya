<?php

namespace App\Http\Controllers;

use App\Lista;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function MongoDB\BSON\fromJSON;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Devuelve una colección de posts paginada y 10 posts aleatorios
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showHome(Request $request){
        $buscador = $request->get('buscador');
        $users = User::user($buscador)->get('id');
        $posts = Post::post($buscador,$users)->orderBy('created_at','DESC')->paginate(3);
        //$posts = Post::orderBy('created_at','DESC')->paginate(3);}

        $random_posts = DB::table('posts')
            ->inRandomOrder()
            ->take(10)
            ->get();

        return view("home", compact("posts","random_posts"),compact('buscador'));

    }

    /**
     * Devuelve una página a la vista parcial de cards
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function paginacion(Request $request){
        $buscador = $request->get('buscador');
        $users = User::user($buscador)->get('id');
        //paginate() sólo se puede usar sobre una query, no una Collection
        $posts = Post::post($buscador,$users)->orderBy('created_at','DESC')->paginate(3);

        return view("posts._cards", compact("posts"),compact('buscador'));
    }

}
