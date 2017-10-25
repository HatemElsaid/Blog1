<?php
use Illuminate\Support\Facades\Redis;
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
Route::get('/', function () {
    return view('welcome');
});
// Route::get('/', function () {
//     return view('auth.register');
// });

Auth::routes();
Route::get('/arrangLiked', 'ArrangLikedController@mostLiked');
Route::get('/arrang', 'HomeController@mostViews');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/post' , "PostController@post")->middleware('auth');
Route::get('/profile' , "ProfileController@profile");
Route::get('/category' , "CategoryController@category");
Route::post('/addCategory' , "CategoryController@addCategory");
Route::post('/addProfile' , "ProfileController@addProfile");
Route::post('/addPost' , "PostController@addPost");
Route::get('/view/{id}' , "PostController@view")->middleware('auth');
Route::get('/edit/{id}' , "PostController@edit");
Route::post('/editPost/{id}' , "PostController@editPost");
Route::get('/deletePost/{id}' , "PostController@deletePost");
Route::get('/category/{id}' , "PostController@category");
Route::get('/like/{id}' , "PostController@like");
Route::get('/dislike/{id}' , "PostController@disLike");
// Route::post('/like' , "PostController@postLikePost");
// Route::post('/like' , 'LikeController@index')->middleware('auth');
 

