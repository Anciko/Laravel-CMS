<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\HomeController;
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

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('category', CategoryController::class);
    Route::resource('post', PostController::class);
    Route::get('home', [HomeController::class, 'index'])->name('home');
});
// Route::prefix('admin')->group(function() {
//     Route::resource('category', CategoryController::class);
// });

Route::get('/', function () {
    return redirect('login');
});


Auth::routes();
