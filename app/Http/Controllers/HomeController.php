<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

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
    public function showHome(){
        //paginate() sólo se puede usar sobre una query, no una Collection
        $posts = Post::paginate(3)->sortByDesc('created_at');

        $random_posts = DB::table('posts')
            ->inRandomOrder()
            ->take(10)
            ->get();

        return view("home", compact("posts","random_posts"));
    }

    /**
     * Devuelve una página a la vista parcial de cards
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function paginacion(){
        //paginate() sólo se puede usar sobre una query, no una Collection
        $posts = Post::paginate(3)->sortByDesc('created_at');

        return view("posts._cards", compact("posts"));
    }
}
