@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Kategori</h1>
        <a href="{{ route('categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Kategori</a>
    </div>
    @if(session('success'))<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>@endif
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100"><tr><th class="px-4 py-3 text-left">Nama</th><th class="px-4 py-3 text-left">Keterangan</th><th class="px-4 py-3 text-left">Jumlah Buku</th><th class="px-4 py-3 text-left">Aksi</th></tr></thead>
            <tbody>
                @forelse($categories as $cat)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $cat->nama }}</td>
                        <td class="px-4 py-3">{{ $cat->keterangan ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $cat->books_count }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ route('categories.edit', $cat) }}" class="text-yellow-600 hover:text-yellow-800 mr-2">Edit</a>
                            <form action="{{ route('categories.destroy', $cat) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:text-red-800">Hapus</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-4 py-8 text-center text-gray-500">Belum ada data kategori.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $categories->links() }}</div>
</div>
@endsection
