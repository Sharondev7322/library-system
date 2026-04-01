@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6"><a href="{{ route('categories.index') }}" class="text-blue-600 hover:text-blue-800">← Kembali</a></div>
    <div class="bg-white rounded-lg shadow-md p-6 max-w-2xl">
        <h1 class="text-2xl font-bold mb-6">Edit Kategori</h1>
        @if($errors->any())<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4"><ul class="list-disc list-inside">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
        <form action="{{ route('categories.update', $category) }}" method="POST">@csrf @method('PUT')
            <div class="mb-4"><label class="block text-gray-700 font-semibold mb-2">Nama Kategori *</label><input type="text" name="nama" value="{{ old('nama', $category->nama) }}" class="w-full border rounded px-3 py-2" required></div>
            <div class="mb-4"><label class="block text-gray-700 font-semibold mb-2">Keterangan</label><textarea name="keterangan" class="w-full border rounded px-3 py-2" rows="3">{{ old('keterangan', $category->keterangan) }}</textarea></div>
            <div class="flex gap-2"><button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan</button><a href="{{ route('categories.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Batal</a></div>
        </form>
    </div>
</div>
@endsection
