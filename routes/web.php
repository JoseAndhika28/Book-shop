<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('auth.login');
})->name('login');

//Authencation Routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('create'); // Route untuk menyimpan data registrasi namanya itu create. Itu bisa dilihat dari ->name('create') di route

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Dashboard Route
// Route::get('/dashboard', [DashboardController::class, 'index']); // Perhatikan route anda🙏🏻 .. Nyambung ke Controller mana dan fungsi mana
Route::get('/dashboard', [BookController::class, 'index']);
//Book Routes
Route::resource('books', BookController::class);
