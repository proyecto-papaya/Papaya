<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class postController extends Controller
{
    public function showForm() {
        return view("formulario_post");
    }
}
