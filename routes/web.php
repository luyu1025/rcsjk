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

Route::group(['prefix' => 'admin'],function (){
    Route::get('/', 'AdminController@index')->name('admin');
    Route::get('login', 'AdminController@login');
});
Route::group(['prefix' => 'cv'],function (){
    Route::get('getlist','PostController@list');
    Route::post('add','PostController@add');
    Route::post('change','PostController@change');
    Route::get('/','PostController@vue');
});

Route::group(['prefix' => 'api'],function (){
    Route::get('getMenu','AdminController@getMenu');    //获取菜单
    Route::post('uploadImg','ApiController@uploadImg'); //上传图片
    Route::post('login','AuthController@login');        //用户登陆
    Route::get('isLogin','AuthController@isLogin');     //判断是否登陆
    Route::get('logout','AuthController@logout');       //登出
    Route::get('captcha','AuthController@captcha');     //获取验证码
    Route::post('register', 'AuthController@register'); //注册
    Route::post('sendMessage', 'PostController@msgReg');//发送短信测试
    Route::get('test', 'AdminController@test');         //测试专用
    Route::get('getMine','AdminController@getMine');    //获取当前用户信息
    Route::post('posts', 'AdminController@getPosts');   //获取文章列表
    Route::post('addPost', 'AdminController@addPost');  //添加文章
    Route::post('delPost','AdminController@delPost');   //删除文章
    Route::post('editPost','AdminController@editPost');   //修改文章
    Route::group(['prefix' => 'content'],function (){
        Route::post('initPost', 'ContentController@initPost');
        Route::post('reInitPost', 'ContentController@reInitPost');
        Route::post('delPost', 'ContentController@delPost');
        Route::post('edit', 'ContentController@edit');
        Route::post('uploadImg','ContentController@uploadImg');
        Route::post('getPosts','ContentController@getPosts');
        Route::post('changeStatus','ContentController@changeStatus');
        Route::post('getPostById', 'ContentController@getPostById');
    });
    Route::group(['prefix'=> 'banner'],function (){
        Route::post('getBanners','ContentController@getBanners');
        Route::post('addBanner','ContentController@addBanner');
        Route::post('editBanner','ContentController@editBanner');
        Route::post('delBanner','ContentController@delBanner');
        Route::post('upload','ContentController@uploadBanner');
    });
    Route::group(['prefix' => 'user'],function (){
        Route::group(['prefix' => 'info'], function (){
            Route::get('getUser', 'AuthController@getUser');
            Route::get('educations','ApiController@educations');
        });
        Route::group(['prefix' => 'edit'], function (){

        });
        Route::group(['prefix' => 'del'], function (){

        });
        Route::group(['prefix' => 'add'], function (){

        });
    });
    Route::group(['prefix'=>'admin'],function (){
        Route::post('login','AuthController@admin_login')->name('admin_login');
        Route::get('logout', 'AuthController@admin_logout');
    });
});

//Route::post('/yzm/send','PostController@sendMessage');
Route::post('/yzm/send','PostController@msgReg');

