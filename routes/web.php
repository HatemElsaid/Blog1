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
Route::get('/arrangLiked', 'ArrangLikedController@mostLiked')->middleware('auth');
Route::get('/arrang', 'HomeController@mostViews')->middleware('auth');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/post' , "PostController@post")->middleware('auth');
Route::get('/profile' , "ProfileController@profile")->middleware('auth');
Route::get('/category' , "CategoryController@category")->middleware('auth');
Route::post('/addCategory' , "CategoryController@addCategory")->middleware('auth');
Route::post('/addProfile' , "ProfileController@addProfile")->middleware('auth');
Route::post('/addPost' , "PostController@addPost")->middleware('auth');
Route::get('/view/{id}' , "PostController@view")->middleware('auth');
Route::get('/edit/{id}' , "PostController@edit")->middleware('auth');
Route::post('/editPost/{id}' , "PostController@editPost")->middleware('auth');
Route::get('/deletePost/{id}' , "PostController@deletePost")->middleware('auth');
Route::get('/category/{id}' , "PostController@category")->middleware('auth');
Route::get('/like/{id}' , "PostController@like")->middleware('auth');
Route::get('/dislike/{id}' , "PostController@disLike")->middleware('auth');
// Route::post('/like' , "PostController@postLikePost");
// Route::post('/like' , 'LikeController@index')->middleware('auth');
 

