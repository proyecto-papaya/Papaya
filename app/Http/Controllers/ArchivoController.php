<?php

namespace App\Http\Controllers;

use App\Archivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchivoController extends Controller
{
    public function download($id){
        $archivo = Archivo::findOrFail($id);
        $post = $archivo->post;
        $post->number_downloads++;
        $post->save();

        return Storage::download($archivo->path, $archivo->name);
    }
}
