<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', 'Auth\LoginController@login');
Route::post('/register', 'Auth\RegisterController@register');

Route::group(['middleware' => ['auth:sanctum']], function () {
    
    Route::post('/logout', 'LogoutController@logout');
    Route::post('/post/create','PostsController@store');
    Route::post('/addnewcategory','CategoriesController@store');
    Route::get('/category/get', 'CategoriesController@getCategories');
    Route::get('/post/drafts', 'PostsController@getDrafts');
    Route::get('/posts/edit/{id}', 'PostsController@edit');
    Route::post('/posts/delete/{id}', 'PostsController@destroy');
    Route::patch('/posts/publish/{id}', 'PostsController@publish');
    Route::patch('/posts/feature/{id}', 'PostsController@feature');
    Route::get('/post/livePosts', 'PostsController@getLivePosts');
    Route::get('/user', 'UsersController@getAuthenticatedUser');
    Route::patch('/user/update/{id}', 'UsersController@UpdateUser');
    Route::patch('/user/updateAvatar/{id}', 'UsersController@updateAvatar');
});

Route::get('/topLatestPosts', 'CosmosController@topLatestPosts');
Route::get('/latestPosts', 'CosmosController@latestPosts');
Route::get('/featuredPosts', 'CosmosController@featuredPosts');
Route::get('/singlePost/{slug}', 'CosmosController@singlePost');
Route::get('/addView/{id}', 'CosmosController@addView');


