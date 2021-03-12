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

Route::prefix('admin')->group(function () {
    Route::get('/login', 'UserController@showLogin')->name('admin.showLogin');
    Route::post('/login', 'UserController@checkLogin')->name('admin.checkLogin');
    Route::get('/register', 'UserController@showRegister')->name('admin.showRegister');
    Route::post('/register', 'UserController@checkRegister')->name('admin.checkRegister');
    Route::get('/logout', 'UserController@logout')->name('admin.logout');


});

Route::group(['prefix' => 'admin', 'middleware' => 'checkLogin'], function () {
    Route::get('/', 'PostController@index')->name('admin.index1');
    Route::group(['prefix' => 'post'], function () {
        Route::get('list', 'PostController@index')->name('admin.index');
        Route::get('create', 'PostController@create')->name('admin.create');
        Route::post('reate', 'PostController@store')->name('admin.store');
        Route::get('{id}', 'PostController@destroy')->name('admin.destroy');
        Route::get('edit/{id}/{slug}', 'PostController@edit')->name('admin.edit');
        Route::post('edit/{id}/{slug}', 'PostController@update')->name('admin.update');
    });


});
