<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('post/new', 'PostController@createNew');

Route::get('get/card/all', 'PostController@getCards');

Route::post('get/pictures', 'PictureController@getPictures');
Route::post('set/like', 'PictureController@like');
Route::post('set/dislike', 'PictureController@dislike');
Route::post('get/like', 'PostController@getLike');
Route::post('get/dislike', 'PostController@getDislike');

Route::post('get/like', 'PostController@like');
Route::post('get/dislike', 'PostController@dislike');
Route::post('set/comment', 'PostController@setComment');
Route::post('get/comment', 'PostController@getComment');
Route::post('get/commentsNum', 'PostController@getCommentsNum');
