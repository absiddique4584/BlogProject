<?php

use Illuminate\Support\Facades\Route;



Route::get('/', 'website\WebsiteController@index')->name('index');
Route::get('/post', 'website\WebsiteController@post')->name('post');
Route::get('/posts/{date}', 'website\WebsiteController@post')->name('posts');
Route::get('/post/{id}', 'website\WebsiteController@post')->name('post');
Route::get('/category/{slug}', 'website\WebsiteController@category')->name('category');

//Register Route
Route::post('/register', 'AuthController@register')->name('register');
Route::get('/register', 'AuthController@registerform')->name('register.form');

//Login Route
Route::post('/login', 'AuthController@login')->name('login');
Route::get('/login', 'AuthController@loginform')->name('login.form');
Route::get('/logout', 'AuthController@logout')->name('logout');

Route::group(['middleware'=>'auth'], function (){
    Route::get('/home', 'Admin\AdminController@index')->name('home');

    Route::prefix('categories')->name('categories.')->group(function (){
        Route::get('/', 'Admin\CategoryController@index')->name('index');
        Route::get('/create', 'Admin\CategoryController@create')->name('create');
        Route::post('/store', 'Admin\CategoryController@store')->name('store');
        Route::get('/edit/{title}/{id}', 'Admin\CategoryController@edit')->name('edit');
        Route::put('/update/{id}', 'Admin\CategoryController@update')->name('update');
        Route::delete('/delete/{id}', 'Admin\CategoryController@destroy')->name('delete');
    });

    Route::prefix('posts')->name('posts.')->group(function (){
        Route::get('/', 'Admin\PostController@index')->name('index');
        Route::get('/create', 'Admin\PostController@create')->name('create');
        Route::post('/store', 'Admin\PostController@store')->name('store');
        Route::get('/edit/{id}', 'Admin\PostController@edit')->name('edit');
        Route::put('/update/{id}', 'Admin\PostController@update')->name('update');
        Route::delete('/delete/{id}', 'Admin\PostController@destroy')->name('delete');
    });

});

