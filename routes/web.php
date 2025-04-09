<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('auth.login');
})->name('login');

//Middleware
Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

//Authencation Routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('create'); // Route untuk menyimpan data registrasi namanya itu create. Itu bisa dilihat dari ->name('create') di route

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Dashboard Route
// Route::get('/dashboard', [DashboardController::class, 'index']); // Perhatikan route anda🙏🏻 .. Nyambung ke Controller mana dan fungsi mana
Route::get('/dashboard', [BookController::class, 'index'])->name('admin.dashboard');

//Book Routes
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit'); 
Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show'); // Route untuk menampilkan detail buku
