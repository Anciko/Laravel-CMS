<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('category', CategoryController::class);
    Route::resource('post', PostController::class);
    Route::resource('tag', TagController::class);
    Route::get('home', [HomeController::class, 'index'])->name('home');

    //For user
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}', [UserController::class, 'edit']);
    Route::patch('/user/{id}', [UserController::class, 'update']);

});

Route::get('/', function () {
    return redirect('login');
});


Auth::routes();
