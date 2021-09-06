<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::put('/users/{user}/update', [UserController::class, 'update'])->name('user.profile.update');

//    Route::get('admin/users' , [UserController::class , 'index'])->name('user.index');
    Route::delete('/users/{user}/destroy', [UserController::class, 'destroy'])->name('user.destroy');

});
Route::middleware(['can:view,user'])->group(function () {
    Route::get('/users/{user}/profile', [UserController::class, 'show'])->name('user.profile.show');
});


Route::middleware(['role:Admin', 'auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::patch('users/{user}/attach', [UserController::class, 'attach'])->name('user.role.attach');
    Route::patch('users/{user}/detach', [UserController::class, 'detach'])->name('user.role.detach');
});
