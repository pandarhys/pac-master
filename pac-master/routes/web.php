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


Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::group(['middleware' => 'is_admin'], function () {
//    Route::get('/admin', 'AdminController@admin')
//        ->middleware('is_admin')
//        ->name('admin');
        Route::get('/pendingArticles', 'ArticlesController@pendingArticles')
                    ->middleware('is_admin')
                    ->name('admin');;
    });

    Route::resource('article', 'ArticlesController');


    Route::post('/article/{article}/tasks', 'ArticleTasksController@store');
    Route::patch('/article/{article}/tasks/{task}', 'ArticleTasksController@update');
    Route::post('/article/{article}/invitations', 'ArticleInvitationsController@store');
});


Auth::routes();
