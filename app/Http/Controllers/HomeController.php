<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Category;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $books = Book::all();
        return view('user.home', compact('books'));
    }

    public function index()
{
    $categories = Category::all();
    return view('user.home', compact('categories')); // sesuaikan nama view-mu
}

    public function about()
    {
        return view('user.about');
    }
}
