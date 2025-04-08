<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        // Disini ga ada variable $books dan sama sekali ga ngembaliin 🙏🏻🙏🏻🙏🏻
        return view('admin.dashboard');
    }
}
