<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = [
        "text"
    ];

    /**Relación N:1 con User
     *
     * Un usuario tiene N comentarios pero un comentario pertenece a 1 usuario
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('App\User');
    }

    /**Relación N:1 con Post
     *
     * Un post tiene N comentarios pero un comentario pertenece a 1 post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post(){
        return $this->belongsTo('App\Post');
    }
}
