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

Route::get('/', 'pageController@home');
Route::get('/post/view/{id}/{post}', 'pageController@view');
Route::get('/post/create', ['middleware' => 'auth', 'uses' => 'pageController@createPost']);
Route::get('/post/overzicht', ['middleware' => 'auth', 'uses' => 'pageController@postsOverview']);
Route::get('/user/settings', ['middleware' => 'auth', 'uses' => 'pageController@permissions']);
Route::get('/user/edit/rank/{rank}', ['middleware' => 'auth', 'uses' => 'pageController@ranks']);
Route::get('/user/profile/{user}/{username}', ['middleware' => 'auth', 'uses' => 'pageController@userProfile']);
Route::get('delete-post/{post}', ['middleware' => 'auth', 'uses' => 'PermController@deletePost']);
Route::get('delete-comment/{comment}', ['middleware' => 'auth', 'uses' => 'PermController@deleteComment']);

Route::post('create-perm', ['middleware' => 'auth', 'uses' => 'PermController@createPerm']);
Route::post('submit-comment', ['middleware' => 'auth', 'uses' => 'PermController@CreateBlogCommentRequest']);
Route::post('submit-post', ['middleware' => 'auth', 'uses' => 'PermController@CreateBlogPostRequest']);
Route::post('create-role', ['middleware' => 'auth', 'uses' => 'PermController@createRole']);
Route::post('submit-group-settings', ['middleware' => 'auth', 'uses' => 'PermController@editRole']);
Route::post('save-user-group', ['middleware' => 'auth', 'uses' => 'PermController@editUserGroup']);
Route::post('submit-delete-group', ['middleware' => 'auth', 'uses' => 'PermController@deleteGroup']);
Route::post('submit-delete-comment', ['middleware' => 'auth', 'uses' => 'PermController@deleteComment']);
Route::post('submit-delete-post', ['middleware' => 'auth', 'uses' => 'PermController@deletePost']);
Route::post('webzey-search', 'PageController@search');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
