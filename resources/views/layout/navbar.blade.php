<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <nav class="text-black w-full px-4 sticky top-0 z-10 bg-blue-500 shadow-md">
      <div class="container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <a href="home.html" class="flex items-center justify-between p-2">
          <h1 class="inline-block font-semibold text-xl">Book Shop</h1>
        </a>

        <!-- Menu -->
        <ul class="flex space-x-6 justify-center items-center">
          <li><a href="{{ route('admin.dashboard') }}" class="hover:text-gray-300">Dashboard</a></li>
          <li class="bg-red-500 px-3 py-1 rounded-2xl hover:bg-red-600"><form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-md text-white">Logout</button>
        </form>
        </li>
        </ul>
      </div>
    </nav>
    
    <div class="container mx-auto mt-4">
        @yield('container')
    </div>
</body>
</html>