<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login', [
            'title' => 'Login'
        ]);

        if ($validator->fails()) {
            return redirect(route('login'))
                ->withErrors($validator)
                ->withInput();
        }
        
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:8'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            //Autentikasi Roles
            if (Auth::user()->roles == 'admin') {
                return redirect()->to('/dashboard');
            } else  {

                return redirect()->to('/home');
            }

        }
        return back()->with('loginError', 'Login gagal!');
    }

    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect(route('login')); // Redirect ke halaman login setelah logout
}
}
