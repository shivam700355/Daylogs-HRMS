<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

Route::get('/', [LoginController::class, 'index']);
Route::get('/layout/header', [LoginController::class, 'layout'])->name('layout');

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::resource('users', UserController::class);
Route::get('register', [LoginController::class, 'register'])->name('register');
Route::post('registerpost', [LoginController::class, 'registerpost'])->name('registerpost');

Route::get('userlist', [LoginController::class, 'userlist'])->name('userlist');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
