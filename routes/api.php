<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//apis
Route::post('register', 'ApiController@register');

Route::post('login', 'ApiController@login');

Route::get('get_funerals', 'ApiController@get_funerals');

Route::post('add_funeral', 'ApiController@add_funeral');

Route::post('update_funeral', 'ApiController@update_funeral');

Route::get('delete_funeral', 'ApiController@delete_funeral');

Route::get('get_all_funerals', 'ApiController@get_all_funerals');

//update_funeral