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

////////////RUTAS CARLOS/////////////////////////////////////////

Route::get('formPost','postController@showForm');

Route::post('createPost','postController@createPost');


/////////////////////////////////////////////////////////////////

///////////// RUTA ANNY /////////////////////////////////////

Route::get('deletePost{id}', 'postController@deletePost');

/////////////////////////////////////////////////////////////////

/////////////////////777777777777777777777777777777/////////////////////////

//Mostrar home (falta middleware)
Route::get('/','postController@showHome');
Route::get('/pages','postController@paginacion');
