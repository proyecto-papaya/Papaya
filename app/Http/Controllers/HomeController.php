<?php

namespace App\Http\Controllers;

use App\Lista;
use App\Post;
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
    public function showHome(){
        //paginate() sólo se puede usar sobre una query, no una Collection
        $posts = Post::orderBy('created_at','DESC')->paginate(3);

        $random_posts = DB::table('posts')
            ->inRandomOrder()
            ->take(10)
            ->get();

        $user_id = Auth::user()->id;

        $lista = Lista::where('user_id','=', $user_id)
            ->with('post_id');

        $favs = DB::select('select distinct post.*, arch.icon
                        from listas list
                        inner join lista_post listp on list.id = listp.lista_id
                        inner join posts post on listp.post_id = post.id
                        inner join archivos arch on arch.post_id = post.id
                        where list.user_id = ?',[$user_id]);

        return view("home", compact("posts","random_posts", "favs"));

    }

    /**
     * Devuelve una página a la vista parcial de cards
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function paginacion(){
        //paginate() sólo se puede usar sobre una query, no una Collection
        $posts = Post::orderBy('created_at','DESC')->paginate(3);

        return view("posts._cards", compact("posts"));
    }

}
