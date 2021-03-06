<?php

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
    return view('login');
});

Route::get('/register', 'UserController@show_register')->name("show_register");

Route::post('register', 'UserController@register')->name("register");

Route::post('login', 'UserController@login')->name("login");

Route::post('add_funeral', "UserController@add_funeral")->name("add_funeral");

Route::get('/dashboard', 'UserController@show_dashboard')->name("dashboard");

Route::get('/funeral/add', 'UserController@show_add_funeral')->name("show_add_funeral");

Route::get('/funeral/edit/{id}', 'UserController@show_edit_funeral')->name("show_edit_funeral");

Route::post('update', 'UserController@update_funeral')->name("edit");

Route::get('delete', 'UserController@delete_funeral')->name('delete');

Route::get('/make_poster', 'UserController@show_make_poster')->name('show_make_poster');


