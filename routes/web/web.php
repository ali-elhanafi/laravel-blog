<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\CommentrepliesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth' )->group(function (){
    Route::get('/admin', [AdminsController::class, 'index'])->name('admin.index');
    Route::get('/admin/posts/comments', [PostCommentController::class, 'index'])->name('comment.index');
    Route::post('/admin/post/comment',[PostCommentController::class , 'store'])->name('comment.store');
    Route::patch('/admin/post/{comment}/comment',[PostCommentController::class , 'update'])->name('comment.update');
    Route::delete('/admin/post/{comment}/comment',[PostCommentController::class , 'destroy'])->name('comment.delete');
    Route::get('/admin/{post}/comments',[PostCommentController::class,'show'])->name('comment.show');
//
    //user routes

});
Route::middleware('auth' )->group(function (){
    Route::get('/admin/posts/replies', [CommentrepliesController::class, 'index'])->name('reply.index');
    Route::patch('/admin/post/{reply}/replies',[CommentrepliesController::class , 'update'])->name('reply.update');
    Route::delete('/admin/post/{reply}/reply',[CommentrepliesController::class , 'destroy'])->name('reply.delete');
    Route::get('/admin/{comment}/reply',[CommentrepliesController::class,'show'])->name('reply.show');
//
    Route::post('/comment/reply',[CommentrepliesController::class , 'store'])->name('reply.store');

    //user routes

});
