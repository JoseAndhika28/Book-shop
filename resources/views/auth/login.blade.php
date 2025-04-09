<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Book-shop</title>
</head>

<body>
    {{-- Notifikasi registrasi sukses}}
    
    {{-- @if (session()->has('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg fixed top-0 left-1/2 transform -translate-x-1/2 mt-4 z-50">
            {{ session('success') }}
        </div>
    @endif --}}

        {{-- Notifikasi login gagal}}
    
    {{-- @if (session()->has('loginError'))
        <div class="bg-red-500 text-white p-4 rounded-lg fixed top-0 left-1/2 transform -translate-x-1/2 mt-4 z-50">
            {{ session('loginError') }}
        </div>
    @endif --}}

    <section class="container mx-auto mt-10">
        <div class="flex justify-center">
            <div class="w-1/3">
                <h1 class="text-4xl font-bold mb-5 text-center">Masuk Akun</h1>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <input type="email" name="email" id="email"
                            class="form-input mt-1 block w-full h-12 p-6 rounded-lg border border-gray-700 @error('email') border-2 border-red-700 @enderror"
                            placeholder="Email" autofocus required value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <p>{{ $errors->first('email') }}</p>
                            </span>
                        @endif
                    </div>
                    <div class="mb-4">
                        <input type="password" name="password" id="password"
                            class="form-input mt-1 block w-full h-12 p-6 rounded-lg border border-gray-700"
                            placeholder="Password" required>
                    </div>
                    <div class="mb-4">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white flex items-center justify-center font-bold w-full h-10 p-5 mt-5 rounded-lg">Login</button>
                        <p class="text-sm mt-2">Belum memiliki akun? <a class="text-blue-400 hover:text-blue-500"
                                href="{{route('create')}}">Daftar</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>
