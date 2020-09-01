<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', function () {
    return redirect('/topics');
});

Route::get('/topics', 'TopicController@index')->name('topics.index');
Route::get('/topics/create', 'TopicController@create')->name('topics.create');
Route::post('/topics', 'TopicController@store')->name('topics.store');
Route::get('/topics/{topic}/edit', 'TopicController@edit')->name('topics.edit');
Route::put('/topics/{topic}', 'TopicController@update')->name('topics.update');
Route::delete('/topics/{topic}', 'TopicController@destroy')->name('topics.delete');
Route::get('/topics/{topic}/remove', 'TopicController@remove')->name('topics.remove');

Route::get('/topics/{topic}/posts', 'PostController@index')->name('posts.index');
Route::get('/topics/{topic}/posts/create', 'PostController@create')->name('posts.create');
Route::post('/topics/{topic}/posts', 'PostController@store')->name('posts.store');
Route::get('/topics/{topic}/posts/{post}/edit', 'PostController@edit')->name('posts.edit');
Route::put('/topics/{topic}/posts/{post}', 'PostController@update')->name('posts.update');
Route::delete('/topics/{topic}/posts/{post}', 'PostController@destroy')->name('posts.delete');
Route::get('/topics/{topic}/posts/{post}/remove', 'PostController@remove')->name('posts.remove');

Route::get('/topics/{topic}/posts/{post}/comments', 'CommentController@index')->name('comments.index');
Route::get('/topics/{topic}/posts/{post}/comments/create', 'CommentController@create')->name('comments.create');
Route::post('/topics/{topic}/posts/{post}/comments', 'CommentController@store')->name('comments.store');
Route::get('/topics/{topic}/posts/{post}/comments/{comment}/edit', 'CommentController@edit')->name('comments.edit');
Route::put('/topics/{topic}/posts/{post}/comments/{comment}', 'CommentController@update')->name('comments.update');
Route::delete('/topics/{topic}/posts/{post}/comments/{comment}', 'CommentController@destroy')->name('comments.delete');
Route::get('/topics/{topic}/posts/{post}/comments/{comment}/remove', 'CommentController@remove')->name('comments.remove');


Route::get('/profile/{user}', 'UserController@show')->name('profile.show');
Route::get('/profile/{user}/edit', 'UserController@edit')->name('profile.edit');
Route::put('/profile/{user}', 'UserController@update')->name('profile.update');
Route::post('profile/{user}/grant', 'UserController@grantmod')->name('profile.grantModerator');
Route::post('profile/{user}/revoke', 'UserController@revokemod')->name('profile.revokeModerator');


//Route::get('/home', 'HomeController@index')->name('home');
