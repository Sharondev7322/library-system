@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('books.index') }}" class="text-blue-600 hover:text-blue-800">← Kembali ke Daftar Buku</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex flex-col md:flex-row gap-6">
            @if($book->cover_image)
                <div class="w-full md:w-1/3">
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->judul }}" class="w-full rounded-lg shadow">
                </div>
            @endif
            <div class="flex-1">
                <h1 class="text-2xl font-bold mb-4">{{ $book->judul }}</h1>
                <table class="w-full">
                    <tr class="border-b">
                        <td class="py-2 font-semibold text-gray-600 w-1/3">Pengarang</td>
                        <td class="py-2">{{ $book->pengarang }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 font-semibold text-gray-600">ISBN</td>
                        <td class="py-2">{{ $book->isbn }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 font-semibold text-gray-600">Kategori</td>
                        <td class="py-2">{{ $book->category->nama ?? '-' }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 font-semibold text-gray-600">Stok Total</td>
                        <td class="py-2">{{ $book->stok }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 font-semibold text-gray-600">Stok Tersedia</td>
                        <td class="py-2">{{ $book->available_stock }}</td>
                    </tr>
                </table>
                <div class="mt-4 flex gap-2">
                    <a href="{{ route('books.edit', $book) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Yakin hapus buku ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Hapus</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-xl font-bold mb-4">Riwayat Peminjaman</h2>
            @if($book->borrowings->count() > 0)
                <table class="w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2 text-left">Siswa</th>
                            <th class="border p-2 text-left">Tanggal Pinjam</th>
                            <th class="border p-2 text-left">Tanggal Kembali</th>
                            <th class="border p-2 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($book->borrowings as $borrowing)
                            <tr>
                                <td class="border p-2">{{ $borrowing->student->nama }}</td>
                                <td class="border p-2">{{ $borrowing->tanggal_pinjam->format('d M Y') }}</td>
                                <td class="border p-2">{{ $borrowing->tanggal_kembali ? $borrowing->tanggal_kembali->format('d M Y') : '-' }}</td>
                                <td class="border p-2">
                                    <span class="px-2 py-1 rounded text-sm {{ $borrowing->status === 'dipinjam' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                        {{ $borrowing->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">Belum ada riwayat peminjaman.</p>
            @endif
        </div>
    </div>
</div>
@endsection
