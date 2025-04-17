@extends('layout.navbar')

@section('container')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book Shop</title>
</head>
<body>
    <section class="flex items-center justify-center text-center text-black">
        <div class="w-full pl-5">
            <h1 class="text-4xl text-center font-bold">Welcome, {{ Auth::user()->name }}!<h1>
        </div>
    </section>

    {{-- <section>
        <div class="flex flex-wrap gap-2 my-4">
            @foreach ($categories as $category)
                <form action="{{ route('books.byCategory', $category->id) }}" method="GET">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-full shadow">
                        {{ $category->name_category }}
                    </button>
                </form>
            @endforeach
        </div>
    </section> --}}

    <section>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-6">Daftar Buku</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
              @foreach($books as $book)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                  @if($book->cover_image)
                    <img src="{{Storage::url($book->cover_image)}}" class="w-full h-48 object-cover" alt="{{ $book->title }}">
                  @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                      Tidak ada gambar
                    </div>
                  @endif
                  <div class="p-4">
                    <h2 class="text-lg font-semibold">{{ $book->title }}</h2>
                    <p class="text-sm text-gray-600 mb-2">{{ Str::limit($book->author, 80) }}</p>
                    <p class="text-sm text-gray-500 mb-2">Stock : {{ Str::limit($book->stock, 80) }}</p>
                    <p class="text-blue-600 font-bold mb-3">Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                    <form action="{{ route('cart.add', $book->id) }}" method="GET">
                        @csrf
                        {{-- <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Beli</button> --}}
                        <button type="submit" class="bg-green-700 text-white px-3 py-1 rounded">Keranjang</button>
                    </form>
                </div>
                </div>
              @endforeach
            </div>
          </div>
    </section>
</body>
</html>
@endsection