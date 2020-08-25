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

Route::get('/', function () {
    return view('welcome');
});

Auth::loginUsingId(5);

Route::get('/topics', 'TopicController@index')->name('topics.index');
Route::get('/topics/create', 'TopicController@create')->name('topics.create');
Route::post('/topics', 'TopicController@store');
Route::get('/topics/{topic}/edit', 'TopicController@edit')->name('topics.edit');
//Route::get('/topics/{topic}', 'TopicController@show')->name('topics.show');
Route::put('/topics/{topic}', 'TopicController@update')->name('topics.update');
Route::delete('/topics/{topic}', 'TopicController@destroy')->name('topics.delete');

Route::get('/topics/{topic}/posts', 'PostController@index')->name('posts.index');
Route::get('/topics/{topic}/posts/create', 'PostController@create')->name('posts.create');
Route::post('/topics/{topic}/posts', 'PostController@store')->name('posts.store');
Route::get('/topics/{topic}/posts/{post}/edit', 'PostController@edit')->name('posts.edit');
//Route::get('/topics/{topic}/posts/{post}', 'PostController@show')->name('posts.show');
Route::put('/topics/{topic}/posts/{post}', 'PostController@update')->name('posts.update');
Route::delete('/topics/{topic}/posts/{post}', 'PostController@delete')->name('posts.delete');

Route::get('/topics/{topic}/posts/{post}/comments', 'CommentController@index')->name('comments.index');
Route::get('/topics/{topic}/posts/{post}/comments/create', 'CommentController@create')->name('comments.create');
Route::post('/topics/{topic}/posts/{post}/comments', 'CommentController@store')->name('comments.index');
Route::get('/topics/{topic}/posts/{post}/comments/{comment}/edit', 'CommentController@edit')->name('comments.edit');
//Route::get('/topics/{topic}/posts/{post}/comments/{comment}', 'CommentController@show')->name('comments.show');
Route::put('/topics/{topic}/posts/{post}/comments/{comment}', 'CommentController@update')->name('comments.update');
Route::delete('/topics/{topic}/posts/{post}/comments/{comment}', 'CommentController@delete')->name('comments.delete');


Route::get('/profile', function() {
    return view('profile');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
