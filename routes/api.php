<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('post/new', 'PostController@createNew');

Route::get('get/card/all', 'PostController@getCards');

Route::post('get/pictures', 'PictureController@getPictures');

Route::post('set/like', 'PostController@like');
Route::post('set/dislike', 'PostController@dislike');