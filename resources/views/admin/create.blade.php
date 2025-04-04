@extends('layout.navbar')

@section('container')
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6">Tambah Buku Baru</h2>

    {{-- Tampilkan pesan error jika ada --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Tambah Buku --}}
    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="title" class="block text-sm font-semibold">Judul Buku</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}"
                class="w-full border border-gray-300 rounded px-4 py-2 mt-1" required>
        </div>

        <div class="mb-4">
            <label for="author" class="block text-sm font-semibold">Penulis</label>
            <input type="text" name="author" id="author" value="{{ old('author') }}"
                class="w-full border border-gray-300 rounded px-4 py-2 mt-1" required>
        </div>

        <div class="mb-4">
            <label for="publisher" class="block text-sm font-semibold">Penerbit</label>
            <input type="text" name="publisher" id="publisher" value="{{ old('publisher') }}"
                class="w-full border border-gray-300 rounded px-4 py-2 mt-1" required>
        </div>

        <div class="mb-4">
            <label for="price" class="block text-sm font-semibold">Harga</label>
            <input type="number" name="price" id="price" value="{{ old('price') }}"
                class="w-full border border-gray-300 rounded px-4 py-2 mt-1" required>
        </div>

        <div class="mb-4">
            <label for="cover_image" class="block text-sm font-semibold">Gambar Sampul</label>
            <input type="file" name="cover_image" id="cover_image"
                class="w-full border border-gray-300 rounded px-4 py-2 mt-1">
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('books.index') }}" class="text-blue-600 hover:underline">← Kembali</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
