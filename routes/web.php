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

Route::get('/', 'frontend\PostController@index')->name('index');
Route::get('about', 'frontend\PostController@about')->name('about');
Route::get('contact', 'frontend\PostController@contact')->name('contact');
Route::get('p/{id}/{slug}', 'frontend\PostController@post')->name('post');

Route::prefix('reset-password')->group(function () {
    Route::get('/', 'backend\UserController@resetPassword')->name('admin.resetpassword');
    Route::post('/', 'ResetPasswordController@sendMail')->name('password.sendMail');
    Route::get('{token}', 'ResetPasswordController@resetForm')->name('password.showForm');
    Route::post('{token}', 'ResetPasswordController@reset')->name('password.reset');
});

Route::prefix('admin')->group(function () {
    Route::get('login', 'backend\UserController@showLogin')->name('admin.showLogin');
    Route::post('login', 'backend\UserController@checkLogin')->name('admin.checkLogin');
    Route::get('register', 'backend\UserController@showRegister')->name('admin.showRegister');
    Route::post('register', 'backend\UserController@checkRegister')->name('admin.checkRegister');
    Route::get('logout', 'backend\UserController@logout')->name('admin.logout');
});

Route::group(['prefix' => 'admin', 'middleware' => 'checkLogin'], function () {
    Route::get('/', 'backend\PostController@index')->name('admin.index1');
    Route::group(['prefix' => 'post'], function () {
        Route::get('list', 'backend\PostController@index')->name('admin.index');
        Route::get('create', 'backend\PostController@create')->name('admin.create');
        Route::post('create', 'backend\PostController@store')->name('admin.store');
        Route::get('delete/{id}', 'backend\PostController@destroy')->name('admin.destroy');
        Route::get('edit/{id}/{slug}', 'backend\PostController@edit')->name('admin.edit');
        Route::post('edit/{id}/{slug}', 'backend\PostController@update')->name('admin.update');
    });
});
