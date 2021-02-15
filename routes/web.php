<?php

use App\Http\Controllers\PostController;
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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::redirect('/', 'posts');

Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
    Route::get('search', [PostController::class, 'search'])->name('search');
    Route::get('trashed', [PostController::class, 'showDeletedPosts'])->name('deleted.show');
    Route::post('trashed/{post}', [PostController::class, 'recover'])->name('trashed.recover');
    Route::delete('trashed/{id}', [PostController::class, 'delete'])->name('trashed.delete');
});

Route::resource('posts', PostController::class);



