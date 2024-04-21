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
Route::post('/save-post', [PostController::class, 'store'])->name('post.store')->middleware('auth');
Route::get('/view-post/{id}', [PostController::class, 'showPost'])->name('post.show')->middleware('auth');
Route::post('/save-comment', [PostController::class, 'saveComment'])->name('comment.save')->middleware('auth');
Route::get('/edit-post/{id}', [PostController::class, 'edit'])->name('post.edit')->middleware(['auth', 'post.access']);
Route::put('/edit-post/{id}', [PostController::class, 'update'])->name('post.update')->middleware(['auth', 'post.access']);
Route::post('/delete-post/{id}', [PostController::class, 'delete'])->name('post.delete')->middleware(['auth', 'post.access']);
Route::post('/delete-comment/{id}', [PostController::class, 'deleteComment'])->name('comment.delete')->middleware(['auth']);
Route::post('/add-category/{postId}/{categoryId}', [PostController::class, 'addCategory'])->name('category.add')->middleware(['auth']);
Route::post('/remove-category/{postId}/{categoryId}', [PostController::class, 'removeCategory'])->name('category.remove')->middleware(['auth']);
