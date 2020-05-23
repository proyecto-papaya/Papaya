<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function __construct()
    {
        $this->loadFavorites();
    }

    function loadFavorites(){
//        $id = 1;
//        $user_id = Auth::user()->$id;

        $favs = DB::select('select distinct post.*, arch.icon
                        from listas list
                        inner join lista_post listp on list.id = listp.lista_id
                        inner join posts post on listp.post_id = post.id
                        inner join archivos arch on arch.post_id = post.id
                        where list.user_id = ?',[1]);

        return view("layouts.app", compact("favs"));
    }
}
