<?php

namespace App\Http\Controllers;

use App\Archivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchivoController extends Controller
{
    public function download($id){
        $archivo = Archivo::findOrFail($id);

        return Storage::download($archivo->path, $archivo->name);
    }
}
