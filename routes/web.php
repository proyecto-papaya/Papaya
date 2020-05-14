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

Route::get('/home', 'postController@showHome')->name('home');

////////////RUTAS CARLOS/////////////////////////////////////////

Route::get('formPost','postController@showForm');

Route::post('createPost','postController@createPost');

/////////////////////777777777777777777777777777777/////////////////////////

Route::get('deletePost{id}', 'postController@deletePost');

//Mostrar home (falta middleware)
Route::get('/','postController@showHome')->name("home");

Route::get('/pages','postController@paginacion');
