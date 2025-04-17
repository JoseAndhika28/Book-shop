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

    {{-- Form Tambah Kategori --}}
    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="name_category" class="block text-sm font-semibold">Nama Kategori</label>
            <input type="text" name="name_category" id="name_category" value="{{ old('category') }}"
                class="w-full border border-gray-300 rounded px-4 py-2 mt-1" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-semibold">Deskripsi</label>
            <input type="text" name="description" id="description" value="{{ old('description') }}"
                class="w-full border border-gray-300 rounded px-4 py-2 mt-1" required>
        </div>       

        <div class="flex items-center justify-between">
            <a href="{{ route('category.dashboard') }}" class="text-blue-600 hover:underline">← Kembali</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection