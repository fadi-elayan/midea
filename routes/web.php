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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'PageController@icons']);
		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'PageController@maps']);
		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'PageController@notifications']);
		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'PageController@rtl']);
		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'PageController@tables']);
		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'PageController@typography']);
		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'PageController@upgrade']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
Route::post('/createpost' , 'PostController@store')->name('post.create');
Route::get('/user/post/delete/{id}',  'PostController@destroy')->middleware('IsMy')->name('post.delete');
Route::get('/user/post/like/{id}' , 'PostController@likePost')->middleware('IsExist')->name('post.like');
Route::get('/user/post/command/{id}' ,'PostController@commandPost')->middleware('IsExist');
Route::get('/show/post/id/{id}' , 'PostController@show')->middleware('IsExist');
Route::get('/user/post/command/delete/{id}' , 'PostController@delelteCommand');
Route::get('/user/search/{id}' , 'UserController@search')->name('search.user');
Route::post('/user/information' , 'UserController@updateInformation');
Route::get('/user/search/id/{id}' , 'UserController@showUser');
Route::get('/user/FrindRequest/{id}' , 'UserController@frindRequest')->middleware('IsUserExist');
Route::get('/user/show/notification/frindRequest' , 'UserController@showFrindRequest')->name('notify.freind');
Route::get('/show/notification' , 'UserController@showNotification');
Route::group(['middleware' => ['IsMyNotify' , 'IsExistNotify']] ,function (){
    Route::get('/user/accept/frindRequest/{id}' , 'UserController@acceptFrindRequest')->name('user.acceptfrindRequest');
    Route::get('/user/reject/frindRequest/{id}' , 'UserController@rejectFrindRequest')->name('user.rejectfrindRequest');
});
});


