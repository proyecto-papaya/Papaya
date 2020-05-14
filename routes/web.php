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

/////////////////////777777777777777777777777777777/////////////////////////

Route::get('deletePost{id}', 'PostController@deletePost');

//Mostrar home (falta middleware)
Route::get('/','HomeController@showHome')->name("home");
Route::get('/pages','HomeController@paginacion');

//Mostrar detalle de Post
Route::get('/p/{id}','PostController@showDetail');
