<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('post/new', 'PostController@createNew');
Route::get('get/card/all', 'PostController@getCards');