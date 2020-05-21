<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $fillable = [
        "title",
        "private",
        "text",
        "favorite"
    ];

    /** Relación N:1 con Archivo
     *
     * Un post tiene N archivos pero un archivo pertenece a 1 post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function archivos(){
        return $this->hasMany('App\Archivo');
    }

    /** Relación N:1 con Comentario
     *
     * Un post tiene N comentarios pero un comentario pertenece a 1 post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comentarios(){
        return $this->hasMany('App\Comentario');
    }

    /**Relación N:M con Lista
     *
     * Un post puede pertenecer a N listas y una lista puede tener M posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lists(){
        return $this->belongsToMany('App\Lista');
    }

    /**Relación N:1 con User
     *
     * Un usuario tiene N posts pero un post pertenece a 1 usuario
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('App\User');
    }

    /**Relación N:M con Tag
     *
     * Un post puede tener N tags y un tag puede tener M posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }


    public function date(){
        $str = $this->created_at;
        $array = explode(" ",$str);

        $date = $array[0];

        $date_array = explode("-",$date);

        $date = $date_array[2]."/".$date_array[1]."/".$date_array[0];
        return $date;
    }

}
