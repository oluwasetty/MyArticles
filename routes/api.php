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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return "Welcome to my articles store";
});

// route to articles resource
Route::resource('articles', 'ArticleController');

// route to articles comments resource
Route::resource('articles/{id}/comments', 'ArticleCommentController');

// route to articles tags resource
Route::resource('articles/{id}/tags', 'ArticleTagController');

// route to get article like
Route::get('articles/{id}/like', 'LikedArticleController@getArticleLikes');

// route to save article like
Route::post('articles/{id}/like', 'LikedArticleController@saveArticleLike');

// route to get article view
Route::get('articles/{id}/view', 'ViewedArticleController@getArticleViews');

// route to save article view
Route::post('articles/{id}/view', 'ViewedArticleController@saveArticleView');
