<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $fillable = [
        "name",
        "path",
    ];

    /**Relación N:1 con User
     *
     * Un usuario tiene N archivos pero un archivo pertenece a 1 usuario
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('App\User');
    }

    /**Relación N:1 con Post
     *
     * Un post tiene N archivos pero un archivo pertenece a 1 post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post(){
        return $this->belongsTo('App\Post');
    }

    public function basename(){
        $str = $this->path;
        $array = explode("/",$str);

        return $array[count($array)-1];
    }
}
