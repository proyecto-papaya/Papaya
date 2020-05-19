<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    protected $fillable = [
        "title"
    ];

    /**Relación N:M con Post
     *
     * Un post puede pertenecer a N listas y una lista puede tener M posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posts(){
        return $this->belongsToMany('App\Post');
    }

    /**Relación N:1 con User
     *
     * Un usuario tiene N listas pero una lista pertenece a 1 usuario
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
