<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


//主根目录
Route::get('/', 'Auth\AuthController@islogin');
Route::get('index.html', 'Auth\AuthController@islogin');

//用户注册
Route::get('reg.html' , 'Auth\AuthController@reg');
Route::post('reg.html' , 'Auth\AuthController@auto') ;

//用户登录页面
Route::get('login.html' , 'Auth\AuthController@login');
Route::post('login.html' , 'Auth\AuthController@loginin');

//用户退出
Route::any('logout.html' , 'Auth\LogoutController@logout' );

//用户提交留言
Route::match(['GET' , 'POST' ],'IndexController.php' ,[ 'middleware' => 'web'  , 'uses' => 'submit_lyController@submit']);

Route::auth();

Route::get('/home', 'HomeController@index');
