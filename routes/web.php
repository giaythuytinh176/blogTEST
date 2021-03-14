<?php

use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\frontend\PostController;
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

Route::get('/', [PostController::class, 'index'])->name('index');
Route::get('/about', [PostController::class, 'about'])->name('about');
Route::get('/p/{id}/{slug}', [PostController::class, 'post'])->name('post');

Route::prefix('admin')->group(function () {
    Route::get('/login', [UserController::class, 'showLogin'])->name('admin.showLogin');
    Route::post('/login', [UserController::class, 'checkLogin'])->name('admin.checkLogin');
    Route::get('/register', [UserController::class, 'showRegister'])->name('admin.showRegister');
    Route::post('/register', [UserController::class, 'logout'])->name('admin.logout');
});

Route::group(['prefix' => 'admin', 'middleware' => 'checkLogin'], function () {
    Route::get('/', [\App\Http\Controllers\backend\PostController::class, 'index'])->name('admin.index1');
    Route::group(['prefix' => 'post'], function () {
        Route::get('list', [\App\Http\Controllers\backend\PostController::class, 'index'])->name('admin.index');
        Route::get('create', [\App\Http\Controllers\backend\PostController::class, 'create'])->name('admin.create');
        Route::post('create', [\App\Http\Controllers\backend\PostController::class, 'store'])->name('admin.store');
        Route::get('delete/{id}', [\App\Http\Controllers\backend\PostController::class, 'destroy'])->name('admin.destroy');
        Route::get('edit/{id}/{slug}', [\App\Http\Controllers\backend\PostController::class, 'edit'])->name('admin.edit');
        Route::post('edit/{id}/{slug}', [\App\Http\Controllers\backend\PostController::class, 'update'])->name('admin.update');
    });
});
