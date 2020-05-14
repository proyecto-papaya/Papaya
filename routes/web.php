<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', 'PostController@showHome')->name('home');

////////////RUTAS CARLOS/////////////////////////////////////////

Route::get('formPost','PostController@showForm');

Route::post('createPost','PostController@createPost');

Route::get('formPostEditar{id_post}','PostController@showFormEditar');

Route::put('updatePost{id}','PostController@updatePost');
/////////////////////777777777777777777777777777777/////////////////////////

//Mostrar home (falta middleware)
Route::get('/','PostController@showHome')->name("home");

Route::get('/pages','PostController@paginacion');
