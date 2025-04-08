@extends('layout.navbar')

@section('container')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>
    <body class="#">
        <section class="h-screen flex items-center justify-center text-center text-black">
            <div class="h-full w-full pl-5">
                <h1 class="text-3xl text-left font-bold">Welcome, {{ Auth::user()->name }}!<h1>
            </div>
        </section>

        <section>
            <div class="max-w-6xl mx-auto p-6">
                <h1 class="text-2xl font-bold mb-4">Daftar Buku</h1>

                <a href="{{ route('books.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">Tambah Buku</a>

                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 my-4 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto mt-4">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2">Nama</th>
                                <th class="border border-gray-300 px-4 py-2">Harga</th>
                                <th class="border border-gray-300 px-4 py-2">Stok</th>
                                <th class="border border-gray-300 px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                <tr class="border border-gray-300 text-center">
                                    <td class="px-4 py-2">{{ $book->name }}</td>
                                    <td class="px-4 py-2">Rp {{ number_format($book->price, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2">{{ $book->stock }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('books.edit', $book->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Edit</a>

                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded" onclick="return confirm('Yakin ingin menghapus produk ini?');">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </body>
    </html>
@endsection
