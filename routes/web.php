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

/*------------------------------All frontend Route-------------------------------------------*/
// Home Route
Route::get('/','HomeController@index')->name('home');

// Post Route
Route::get('post/{slug}','PostController@details')->name('post.details');
Route::get('posts','PostController@index')->name('post.index');
Route::get('category/{slug}','PostController@postByCategory')->name('post.category');
Route::get('tag/{slug}','PostController@postByTag')->name('post.tag');

// Subscriber Route
Route::post('subscriber','SubscriberController@store')->name('subscriber.store');

// Subscriber Route
Route::get('search','SearchController@search')->name('search');

// Author Profile Route
Route::get('profile/{username}','AuthorController@profile')->name('author.profile');


/*------------------------------All Authentication Route-------------------------------------------*/
Route::group(['middleware'=>['auth']], function (){

    // Favorite Post Route
    Route::post('favorite/{post}/add','FavoriteControllre@add')->name('post.favorite');

    // Comment Route
    Route::post('comment/{post}','CommentsController@store')->name('comment.store');

});

/*------------------------------All Admin Route-------------------------------------------*/
Route::group(['namespace'=>'Admin','as'=>'admin.','prefix'=>'admin','middleware'=>['auth','admin']], function (){
    // Admin Dashboard Route
    Route::get('dashboard','DashboardController@index')->name('dashboard');

    // Admin Settings Route
    Route::get('setting','SettingsController@index')->name('setting');
    Route::put('profile-update','SettingsController@update')->name('profile.update');
    Route::put('password-update','SettingsController@password')->name('password.update');
    Route::put('theme-update','SettingsController@theme')->name('update.theme');

    // Admin Tag Route
    Route::resource('tag','TagController');

    // Admin Category Route
    Route::resource('category','CategoryController');

    // Admin Post Route
    Route::resource('post','PostController');
    Route::get('pending/post','PostController@pending')->name('pending.post');
    Route::put('post/{id}/approve','PostController@approve')->name('post.approve');

    // Admin Subscriber Route
    Route::get('subscriber','SubscriberController@index')->name('subscriber.index');
    Route::delete('subscriber/{id}','SubscriberController@destroy')->name('subscriber.destroy');

    // Admin Theme Route
    Route::resource('theme','ThemeController');

    // Admin Favorite Route
    Route::get('favorite','FavoriteController@index')->name('favorite.index');

    // Admin Comment Route
    Route::get('comment','CommentController@index')->name('comment.index');
    Route::delete('{id}/comment','CommentController@destroy')->name('comment.destroy');

    // Admin Author List Route
    Route::get('author','AuthorController@index')->name('author.index');
    Route::delete('author/{id}','AuthorController@destroy')->name('author.destroy');
});

/*------------------------------All Author Route-------------------------------------------*/
Route::group(['namespace'=>'Author','as'=>'author.','prefix'=>'author','middleware'=>['auth','author']], function (){
    // Author Dashboard Route
    Route::get('dashboard','DashboardController@index')->name('dashboard');

    // Author Post Route
    Route::resource('post','PostController');

    // Author Settings Route
    Route::get('setting','SettingsController@index')->name('setting');
    Route::put('profile-update','SettingsController@update')->name('profile.update');
    Route::put('password-update','SettingsController@password')->name('password.update');
    Route::put('theme-update','SettingsController@theme')->name('update.theme');

    // Author Favorite Post Route
    Route::get('favorite','FavoriteController@index')->name('favorite.index');

    // Author Comment Route
    Route::get('comment','CommentController@index')->name('comment.index');
    Route::delete('{id}/comment','CommentController@destroy')->name('comment.destroy');
});


