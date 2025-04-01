<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request)
    {
        // Untuk debugging juga bisa pake kayak gini. Fungsinya buat ngecek data apa yang dikirim dari depan (Fe) ke belakang (Be)
        Log::info($request->all());

        // Perhatiin Rules yang ada di Validator, itu data request yang biasanya diperlukan dari FE ke BE
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users|max:255',
            'name' => 'required|unique:users|max:255', // Sesuai dokumentasi penggunaan unique seperti ini unique:nama_table,nama_kolom -> Docs https://stackoverflow.com/questions/25663478/laravel-validator-unique-value
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            // Biasanya juga dikasih Log kayak gini buat nampilin errornya di storage/logs/laravel.log
            Log::info('Validation failed: ' . json_encode($validator->errors()));
            return redirect(route('register'))
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Simpan data ke database
            User::create($validator->validated());

            // Redirect ke halaman login dengan pesan sukses
            Log::info('User registered successfully: ' . $request->email);
             //Notifikasi berhasil
            $request->session()->flash('success', 'Registrasi berhasil! Silakan login.');
            return redirect(route('login'))->with('success', 'Registrasi berhasil! Silakan login.');
        } catch (\Throwable $e) {
            // Redirect ke halaman register dengan pesan error
            Log::info('Error registering user: ' . $e->getMessage());
            return redirect(route('register'))
                ->with('error', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.');
        }
    }
}
