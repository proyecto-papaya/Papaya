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

Route::get('deletePost{id}', 'PostController@deletePost');

//Mostrar home (falta middleware)
<<<<<<< HEAD
=======
Route::get('/','HomeController@showHome')->name("home");

Route::get('/pages','HomeController@paginacion');
>>>>>>> 7705cf6f4201e4f775afc3592f191f7fa342a837
