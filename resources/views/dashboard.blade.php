@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
    <p class="text-gray-600">Selamat datang di Sistem Perpustakaan Sekolah</p>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-indigo-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Buku</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalBuku }}</p>
            </div>
            <div class="bg-indigo-100 p-3 rounded-full">
                <i class="fas fa-book text-indigo-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Anggota</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalAnggota }}</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <i class="fas fa-users text-green-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Peminjaman Aktif</p>
                <p class="text-3xl font-bold text-gray-800">{{ $peminjamanAktif }}</p>
            </div>
            <div class="bg-yellow-100 p-3 rounded-full">
                <i class="fas fa-hand-holding text-yellow-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Peminjaman</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalPeminjaman }}</p>
            </div>
            <div class="bg-purple-100 p-3 rounded-full">
                <i class="fas fa-chart-line text-purple-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Borrowings -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">
            <i class="fas fa-history mr-2 text-indigo-600"></i>Peminjaman Terbaru
        </h2>
        @if($peminjamanTerbaru->count() > 0)
            <div class="space-y-3">
                @foreach($peminjamanTerbaru as $peminjaman)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $peminjaman->student->nama }}</p>
                            <p class="text-sm text-gray-600">{{ $peminjaman->book->judul }}</p>
                        </div>
                        <span class="px-3 py-1 text-xs rounded-full {{ $peminjaman->status === 'dipinjam' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                            {{ $peminjaman->status }}
                        </span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center py-4">Belum ada data peminjaman</p>
        @endif
    </div>

    <!-- Popular Books -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">
            <i class="fas fa-fire mr-2 text-orange-600"></i>Buku Populer
        </h2>
        @if($bukuPopuler->count() > 0)
            <div class="space-y-3">
                @foreach($bukuPopuler as $buku)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $buku->judul }}</p>
                            <p class="text-sm text-gray-600">{{ $buku->pengarang }}</p>
                        </div>
                        <span class="bg-indigo-100 text-indigo-800 px-3 py-1 text-xs rounded-full">
                            {{ $buku->borrowings_count }}x dipinjam
                        </span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center py-4">Belum ada data buku</p>
        @endif
    </div>
</div>

<!-- Quick Actions -->
<div class="mt-8 bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-4">
        <i class="fas fa-bolt mr-2 text-yellow-600"></i>Aksi Cepat
    </h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('books.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-center py-4 px-4 rounded-lg transition">
            <i class="fas fa-plus-circle text-2xl mb-2"></i>
            <p>Tambah Buku</p>
        </a>
        <a href="{{ route('students.create') }}" class="bg-green-600 hover:bg-green-700 text-white text-center py-4 px-4 rounded-lg transition">
            <i class="fas fa-user-plus text-2xl mb-2"></i>
            <p>Tambah Anggota</p>
        </a>
        <a href="{{ route('borrowings.create') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white text-center py-4 px-4 rounded-lg transition">
            <i class="fas fa-hand-holding text-2xl mb-2"></i>
            <p>Pinjam Buku</p>
        </a>
        <a href="{{ route('categories.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white text-center py-4 px-4 rounded-lg transition">
            <i class="fas fa-tag text-2xl mb-2"></i>
            <p>Tambah Kategori</p>
        </a>
    </div>
</div>
@endsection
