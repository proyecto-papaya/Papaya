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

Route::get('/home', 'HomeController@showHome')->name('home')->middleware('auth');

////////////RUTAS CARLOS/////////////////////////////////////////

Route::get('formPost','PostController@showForm')->name('showForm')->middleware('auth');

Route::post('createPost','PostController@createPost')->middleware('auth');

Route::get('formPostEditar{id_post}','PostController@showFormEditar')->middleware('auth');

Route::put('updatePost{id}','PostController@updatePost')->middleware('auth');
/////////////////////777777777777777777777777777777/////////////////////////

//Borrar un post
Route::get('deletePost{id}', 'PostController@deletePost')->middleware('auth');

//Mostrar home (Falta middleware)
Route::get('/','HomeController@showHome')->middleware('auth');

//Paginación asíncrona
Route::get('/pages','HomeController@paginacion')->middleware('auth');

//Mostrar detalle de Post
Route::get('/p/{id}','PostController@showDetail')->middleware('auth');

//Añadir comentario
Route::post('/comment/{id}',"ComentarioController@store")->middleware('auth');

//Descargar archivo
Route::get('/download/{id}','ArchivoController@download')->middleware('auth');

//Listas
Route::get('/lists/{idPost}','ListasController@createFavorite')->middleware('auth');
Route::get('/favoritesList','ListasController@listaFavoritos')->middleware('auth');

//Mostrar perfil de usuario
Route::get('/user/{user}','ProfileController@show')->middleware('auth');

//Editar perfil de usuario
Route::put('/user/update/{user}','ProfileController@update')->middleware('auth');

//Editar contraseña
Route::put('/user/update/password/{user}','ProfileController@updatePassword')->middleware('auth');

//Editar foto de perfil
Route::post('/user/picture/update/{user}', 'ProfileController@updateAvatar')->middleware('auth');

//Borrar cuenta usuario loggeado
Route::delete('/user/delete','ProfileController@destroyCurrentUser')->middleware('auth');

//Borrar cuenta usuario
Route::delete('/user/delete/{user}','ProfileController@destroy')->middleware('auth');

//Página de admin
Route::get('/admin','ProfileController@showAdmin')->middleware('checkadmin');

//Seguir un usuario
Route::get('/follow{id_user}','ProfileController@follow')->middleware('auth');

Route::get('/unFollow{id_user}','ProfileController@unFollow')->middleware('auth');

Route::get('/deleteFollower{id_user}','ProfileController@deleteFollower')->middleware('auth');

Route::get('/deleteFollowed{id_user}','ProfileController@deleteFollowed')->middleware('auth');
