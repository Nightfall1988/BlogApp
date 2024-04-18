<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [PostController::class, 'index'])->name('list')->middleware('auth');
Route::get('/create-post', [PostController::class, 'createPost'])->name('post.create')->middleware('auth');
Route::post('/save-post', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
Route::get('/view-post/{id}', [PostController::class, 'showPost'])->name('posts.show')->middleware('auth');
Route::post('/save-comment', [PostController::class, 'saveComment'])->name('save-comment')->middleware('auth');
Route::get('/edit-post/{id}', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');
Route::post('/delete-post/{id}', [PostController::class, 'delete'])->name('delete-post')->middleware('auth');