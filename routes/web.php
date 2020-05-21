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

Route::get('/home', 'HomeController@showHome')->name('home');

////////////RUTAS CARLOS/////////////////////////////////////////

Route::get('formPost','PostController@showForm')->name('showForm');

Route::post('createPost','PostController@createPost');

Route::get('formPostEditar{id_post}','PostController@showFormEditar');

Route::put('updatePost{id}','PostController@updatePost');
/////////////////////777777777777777777777777777777/////////////////////////

//Borrar un post
Route::get('deletePost{id}', 'PostController@deletePost');

//Mostrar home (Falta middleware)
Route::get('/','HomeController@showHome');

//Paginación asíncrona
Route::get('/pages','HomeController@paginacion');

//Mostrar detalle de Post
Route::get('/p/{id}','PostController@showDetail');

//Añadir comentario
Route::post('/comment/{id}',"ComentarioController@store");

//Descargar archivo
Route::get('/download/{id}','ArchivoController@download');

//Listas
Route::get('/lists/{idPost}','ListasController@createFavorite');
Route::get('/favoritesList','ListasController@favPosts');

//Mostrar perfil de usuario
Route::get('/user/{user}','ProfileController@show');

//Editar perfil de usuario
Route::put('user/update/{user}','ProfileController@update');
