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


});

Route::group(['prefix' => 'admin', 'middleware' => 'checkLogin'], function () {
    Route::get('/', 'UserController@index')->name('admin.index1');
    Route::get('/post/list', 'UserController@index')->name('admin.index');
    Route::get('/post/create', 'PostController@create')->name('admin.create');
    Route::post('/post/create', 'PostController@store')->name('admin.store');


});
