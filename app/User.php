<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile_picture', 'description', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /** Relación N:1 con Post
     *
     * Un usuario tiene N posts pero un post pertenece a 1 usuario
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(){
        return $this->hasMany('App\Post');
    }

    /** Relación N:1 con Archivo
     *
     * Un usuario tiene N archivos pero un archivo pertenece a 1 usuario
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function archivos(){
        return $this->hasMany('App\Archivo');
    }

    /** Relación N:1 con Comentario
     *
     * Un usuario tiene N comentarios pero un comentario pertenece a 1 usuario
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comentarios(){
        return $this->hasMany('App\Comentario');
    }

    /** Relación N:1 con Lista
     *
     * Un usuario tiene N listas pero una lista pertenece a 1 usuario
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function listas(){
        return $this->hasMany('App\Lista');
    }

    public function favoritosUsuario(){
        $favsUser = new Lista();
        $favsUser = $this->listas()->where('title','=', 'Favoritos');
        return $favsUser;

        return view('layouts.app', compact("favsUser"));
    }

}
