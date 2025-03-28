<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users|max:255',
            'name' => 'required|unique:post|max:255',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return redirect(route('register'))
                ->withErrors($validator)
                ->withInput();
        }

    try{
        // Simpan data ke database
        User::create($validatedData);
    
        // Redirect ke halaman login dengan pesan sukses
        return redirect(route('login'))->with('success', 'Registrasi berhasil! Silakan login.');
        } catch(Exception $error) {
            // Redirect ke halaman register dengan pesan error
            Log::error('Error registering user: ' . $error->getMessage());
            return redirect(route('register'))
                ->with('error', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.');
        }
    }    
}
