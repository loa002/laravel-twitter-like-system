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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//ログイン中のみの処理
Route::group(['middleware' => 'auth'], function(){
    //ユーザ関連機能用
    //今回は一覧表示、個別表示、更新画面(編集)、更新処理(編集更新)を使う
    Route::resource('user', 'UserController', ['only' => ['index', 'show', 'edit', 'update']]);
    Route::post('user/{user}/follow','UserController@follow')->name('user.follow');
    Route::delete('user/{user}/unfollow','UserController@unfollow')->name('user.unfollow');
    //ツイート(ララート)関連機能
    //CRUDなので全メソッド使用
    Route::resource('laraat', 'LaraatController', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
});