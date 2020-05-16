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

    /**
     * Devuelve el tipo de archivo: audio, video, image, text o unknown.
     *
     * @return string
     */
    public function archivo_type(){
        $audio = ['mp3', 'aif', 'cda', 'mid', 'midi', 'mpa', 'ogg', 'wav', 'wma', 'wpl'];
        $video = ['avi','flv','h264', 'm4v', 'mkv', 'mov', 'mp4', 'mpg', 'mpeg', 'rm', 'swf', 'vob', 'wmv'];
        $image = ['ai', 'bmp', 'gif', 'ico', 'jpeg', 'jpg', 'png', 'ps', 'psd', 'svg','tif','tiff'];
        $text = ['pdf', 'doc', 'docx', 'odt', 'rtf', 'tex', 'txt', 'wpd'];

        $extension_array = explode('.',$this->name);
        $extension = strtolower($extension_array[1]);
        $type = "";

        if(in_array($extension, $audio)){
            $type = "audio";
        }
        elseif (in_array($extension, $video)){
            $type = "video";
        }
        elseif (in_array($extension, $image)){
            $type = "image";
        }
        elseif(in_array($extension, $text)){
            $type = "text";
        }
        else{
            $type = "unknown";
        }

        return $type;
    }

    public function icon(){
        $type = $this->archivo_type();
        $icon = "";

        if($type == "audio"){
            $icon = "<i class=\"fas fa-file-audio\"></i>";
        }
        elseif ($type == "video"){
            $icon = "<i class=\"fas fa-file-video\"></i>";
        }
        elseif ($type == "image"){
            $icon = "<i class=\"fas fa-file-image\"></i>";
        }
        elseif ($type == "text"){
            $icon = "<i class=\"fas fa-file-alt\"></i>";
        }
        else{
            $icon = "<i class=\"fas fa-question\"></i>";
        }

        return $icon;
    }
}
