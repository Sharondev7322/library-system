@extends('layouts.app')

@section('title', 'Pencarian')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Pencarian Global</h1>
        <p class="text-gray-600">Cari buku, anggota, dan peminjaman</p>
    </div>

    <!-- Search Form -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <form method="GET" action="{{ route('search') }}">
            <div class="flex gap-4">
                <div class="flex-1 relative">
                    <input type="text" name="q" value="{{ $query }}" 
                        placeholder="Ketik minimal 2 karakter..." 
                        class="w-full pl-10 pr-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-lg">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
                </div>
                <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium">
                    <i class="fas fa-search mr-2"></i>Cari
                </button>
            </div>
        </form>
    </div>

    @if(strlen($query) >= 2)
    <!-- Results Summary -->
    <div class="mb-4">
        <p class="text-gray-600">
            Hasil pencarian untuk <strong>"{{ $query }}"</strong>: 
            <span class="font-semibold text-indigo-600">{{ $totalCount }} hasil</span>
        </p>
    </div>

    <!-- Tabs -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="border-b">
            <nav class="flex -mb-px">
                <a href="{{ route('search', ['q' => $query, 'tab' => 'books']) }}" 
                    class="px-6 py-4 font-medium text-sm border-b-2 transition {{ $tab === 'books' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    <i class="fas fa-book mr-2"></i>Buku
                    <span class="ml-2 px-2 py-0.5 text-xs rounded-full {{ $tab === 'books' ? 'bg-indigo-100 text-indigo-600' : 'bg-gray-100 text-gray-600' }}">{{ $books->count() }}</span>
                </a>
                <a href="{{ route('search', ['q' => $query, 'tab' => 'students']) }}" 
                    class="px-6 py-4 font-medium text-sm border-b-2 transition {{ $tab === 'students' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    <i class="fas fa-users mr-2"></i>Anggota
                    <span class="ml-2 px-2 py-0.5 text-xs rounded-full {{ $tab === 'students' ? 'bg-indigo-100 text-indigo-600' : 'bg-gray-100 text-gray-600' }}">{{ $students->count() }}</span>
                </a>
                <a href="{{ route('search', ['q' => $query, 'tab' => 'borrowings']) }}" 
                    class="px-6 py-4 font-medium text-sm border-b-2 transition {{ $tab === 'borrowings' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    <i class="fas fa-hand-holding mr-2"></i>Peminjaman
                    <span class="ml-2 px-2 py-0.5 text-xs rounded-full {{ $tab === 'borrowings' ? 'bg-indigo-100 text-indigo-600' : 'bg-gray-100 text-gray-600' }}">{{ $borrowings->count() }}</span>
                </a>
            </nav>
        </div>

        <div class="p-6">
            @if($tab === 'books')
                @if($books->isEmpty())
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-book text-4xl mb-3 text-gray-300"></i>
                        <p>Tidak ada buku yang ditemukan.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b bg-gray-50">
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Judul</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Pengarang</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">ISBN</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Kategori</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Stok</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($books as $book)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        <a href="{{ route('books.show', $book->id) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                                            {{ $book->judul }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">{{ $book->pengarang }}</td>
                                    <td class="px-4 py-3 text-gray-600">{{ $book->isbn }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 bg-indigo-100 text-indigo-700 rounded text-xs">{{ $book->category->nama ?? '-' }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="{{ $book->stok > 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $book->stok }} ({{ $book->available_stock }} tersedia)
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('books.show', $book->id) }}" class="text-indigo-600 hover:text-indigo-800">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            @elseif($tab === 'students')
                @if($students->isEmpty())
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-users text-4xl mb-3 text-gray-300"></i>
                        <p>Tidak ada anggota yang ditemukan.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b bg-gray-50">
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Nama</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">NIS</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Kelas</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Alamat</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        <a href="{{ route('students.show', $student->id) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                                            {{ $student->nama }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">{{ $student->nis }}</td>
                                    <td class="px-4 py-3 text-gray-600">{{ $student->kelas }}</td>
                                    <td class="px-4 py-3 text-gray-600">{{ $student->alamat ?? '-' }}</td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('students.show', $student->id) }}" class="text-indigo-600 hover:text-indigo-800">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            @elseif($tab === 'borrowings')
                @if($borrowings->isEmpty())
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-hand-holding text-4xl mb-3 text-gray-300"></i>
                        <p>Tidak ada peminjaman yang ditemukan.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b bg-gray-50">
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Anggota</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Buku</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tanggal Pinjam</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($borrowings as $borrowing)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        <a href="{{ route('students.show', $borrowing->student->id) }}" class="text-indigo-600 hover:text-indigo-800">
                                            {{ $borrowing->student->nama }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('books.show', $borrowing->book->id) }}" class="text-indigo-600 hover:text-indigo-800">
                                            {{ $borrowing->book->judul }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">{{ $borrowing->tanggal_pinjam->format('d M Y') }}</td>
                                    <td class="px-4 py-3">
                                        @php
                                            $statusClass = [
                                                'dipinjam' => 'bg-yellow-100 text-yellow-700',
                                                'dikembalikan' => 'bg-green-100 text-green-700',
                                                'terlambat' => 'bg-red-100 text-red-700'
                                            ];
                                            $status = $borrowing->status;
                                            if ($status === 'dipinjam' && $borrowing->tanggal_kembali && $borrowing->tanggal_kembali < now()) {
                                                $status = 'terlambat';
                                            }
                                        @endphp
                                        <span class="px-2 py-1 rounded text-xs font-medium {{ $statusClass[$status] ?? 'bg-gray-100 text-gray-700' }}">
                                            {{ ucfirst($status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('borrowings.show', $borrowing->id) }}" class="text-indigo-600 hover:text-indigo-800">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @endif
        </div>
    </div>
    @elseif(strlen($query) > 0 && strlen($query) < 2)
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-yellow-700">
            <i class="fas fa-info-circle mr-2"></i>
            Ketik minimal 2 karakter untuk melakukan pencarian.
        </div>
    @else
        <div class="bg-white rounded-lg shadow p-8 text-center">
            <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Mulai Mencari</h2>
            <p class="text-gray-500">Ketik kata kunci untuk mencari buku, anggota, dan peminjaman.</p>
        </div>
    @endif
</div>
@endsection
