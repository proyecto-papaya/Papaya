<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListaPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_post', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lista_id')->unsigned();
            $table->bigInteger('post_id')->unsigned();

            $table->timestamps();

            $table->foreign('lista_id')->references('id')->on('listas')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lista_post');
    }
}
