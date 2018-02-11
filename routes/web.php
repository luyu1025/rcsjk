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

Route::group(['prefix' => 'cv'],function (){
    Route::get('getlist','PostController@list');
    Route::post('add','PostController@add');
    Route::post('change','PostController@change');
    Route::get('/','PostController@vue');
});

Route::group(['prefix' => 'api'],function (){
    Route::group(['prefix' => 'user'],function (){
        Route::group(['prefix' => 'info'], function (){
            Route::get('all', 'ApiController@getUserInfo');
            Route::get('educations','ApiController@educations');
        });
        Route::group(['prefix' => 'edit'], function (){

        });
        Route::group(['prefix' => 'del'], function (){

        });
        Route::group(['prefix' => 'add'], function (){

        });
    });
});

//Route::post('/yzm/send','PostController@sendMessage');
Route::post('/yzm/send','PostController@msgReg');

