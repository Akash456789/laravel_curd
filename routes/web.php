<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', [UserController::class, 'create'])->name('create');
Route::post('/store', [UserController::class, 'store'])->name('store');
Route::get('/index', [UserController::class, 'index'])->name('index');
Route::delete('/curd/{id}', [UserController::class, 'destroy'])->name('destroy');

Route::get('/curd/{id}/edit', [UserController::class, 'edit'])->name('edit');
Route::put('/curd/{id}', [UserController::class, 'update'])->name('update');

