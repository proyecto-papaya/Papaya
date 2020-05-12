<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        "name"
    ];

    /** Relación N:1 con Post
     *
     * Un post puede tener N tags y un tag puede pertenecer a M posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts(){
        return $this->belongsToMany('App\Post');
    }
}
