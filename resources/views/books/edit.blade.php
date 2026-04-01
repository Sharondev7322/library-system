@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('books.index') }}" class="text-blue-600 hover:text-blue-800">← Kembali ke Daftar Buku</a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 max-w-2xl">
        <h1 class="text-2xl font-bold mb-6">Edit Buku</h1>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Judul Buku *</label>
                <input type="text" name="judul" value="{{ old('judul', $book->judul) }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Pengarang *</label>
                <input type="text" name="pengarang" value="{{ old('pengarang', $book->pengarang) }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">ISBN *</label>
                <input type="text" name="isbn" value="{{ old('isbn', $book->isbn) }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Kategori *</label>
                <select name="category_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>{{ $category->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Stok *</label>
                <input type="number" name="stok" value="{{ old('stok', $book->stok) }}" min="0" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Cover Image</label>
                @if($book->cover_image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover" class="w-32 h-40 object-cover rounded">
                    </div>
                @endif
                <input type="file" name="cover_image" accept="image/*" class="w-full border rounded px-3 py-2">
                <p class="text-sm text-gray-500 mt-1">Format: JPEG, PNG, JPG. Maks 2MB.</p>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan</button>
                <a href="{{ route('books.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
