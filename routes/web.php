<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

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

//Category Routes
Route::get('/category', [CategoryController::class, 'index'])->name('category.dashboard');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.show'); // Route untuk menampilkan detail kategori
Route::get('/books/category/{id}', [BookController::class, 'byCategory'])->name('books.byCategory');

//Book Routes
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::get('/books/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show'); // Route untuk menampilkan detail buku


//User Routes
Route::get('/home', [HomeController::class, 'home'])->name('home'); // Route untuk menampilkan halaman home
Route::get('/about', [HomeController::class, 'about'])->name('about'); // Route untuk menampilkan halaman about

//Cart Routes
Route::get('/books/{id}/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add'); // Route untuk menambahkan buku ke keranjang
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout'); // Route untuk menampilkan halaman checkout
Route::delete('/cart', [CartController::class, 'deleteSelected'])->name('cart.delete'); // Route untuk menghapus item dari keranjang

//Order

