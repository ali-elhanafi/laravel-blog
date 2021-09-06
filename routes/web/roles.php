<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/roles',[RoleController::class, 'index'])->name('roles.index');

Route::get('/roles/{role}/edit',[RoleController::class, 'edit'])->name('roles.edit');

Route::post('/roles',[RoleController::class, 'store'])->name('roles.store');

Route::delete('/roles/{role}/destroy',[RoleController::class, 'destroy'])->name('roles.destroy');
Route::put('/roles/{role}/update',[RoleController::class, 'update'])->name('roles.update');
Route::put('users/{role}/attach', [RoleController::class, 'attach'])->name('role.permission.attach');
Route::put('users/{role}/detach', [RoleController::class, 'detach'])->name('role.permission.detach');
