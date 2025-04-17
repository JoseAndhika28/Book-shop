<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <nav class="text-black w-full px-4 sticky top-0 z-10 bg-white shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo -->
            <a href="home.html" class="flex items-center justify-between p-2">
                <h1 class="inline-block font-semibold text-xl">Book Shop</h1>
            </a>

            <!-- Menu -->
            <ul class="flex space-x-6 justify-center items-center font-semibold">
                <li>
                    <form action="/search" method="GET" class="hidden md:flex items-center ml-4">
                        <input
                          type="text"
                          name="query"
                          placeholder="Search..."
                          class="px-3 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                      </form>
                </li>

                @auth
                    <!--Menu Admin-->
                    @if (auth()->user()->roles == 'admin')
                    <li><a href="{{ route('admin.dashboard') }}" class="hover:text-gray-300">Dashboard</a></li>
                    <li><a href="{{ route('category.dashboard') }}" class="hover:text-gray-300">Categories</a></li>
                    {{-- <li><a href="{{ route('admin.confirm') }}" class="hover:text-gray-300">Confirm</a></li> --}}
                    @else
                        <!--Menu User-->
                        <li><a href="{{ route('home') }}" class="hover:text-gray-300">Home</a></li>
                        <li><a href="{{ route('home') }}" class="hover:text-gray-300">About us</a></li>
                        <li><a href="{{ route('home') }}" class="hover:text-gray-300">Contact</a></li>
                        <li class="text-white bg-blue-500 px-3 py-1 rounded-2xl hover:bg-blue-600 duration-300"><a href="{{ route('cart.index') }}" class=""><i class="bi bi-cart"></i> Cart</a></li>
                        @endif
                    <li class="bg-red-500 px-3 py-1 rounded-2xl hover:bg-red-600 duration-300">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-md text-white"><i class="bi bi-box-arrow-left"></i> Logout</button>
                        </form>
                    </li>
                @endauth

            </ul>
        </div>
    </nav>

    <div class="container mx-auto mt-4">
        @yield('container')
    </div>
</body>

</html>
