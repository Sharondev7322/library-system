@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Peminjaman</h1>
        <a href="{{ route('borrowings.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Pinjam Buku</a>
    </div>
    @if(session('success'))<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>@endif
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100"><tr><th class="px-4 py-3 text-left">Siswa</th><th class="px-4 py-3 text-left">Buku</th><th class="px-4 py-3 text-left">Tgl Pinjam</th><th class="px-4 py-3 text-left">Tgl Kembali</th><th class="px-4 py-3 text-left">Status</th><th class="px-4 py-3 text-left">Aksi</th></tr></thead>
            <tbody>
                @forelse($borrowings as $b)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $b->student->nama }}</td>
                        <td class="px-4 py-3">{{ $b->book->judul }}</td>
                        <td class="px-4 py-3">{{ $b->tanggal_pinjam->format('d M Y') }}</td>
                        <td class="px-4 py-3">{{ $b->tanggal_kembali ? $b->tanggal_kembali->format('d M Y') : '-' }}</td>
                        <td class="px-4 py-3"><span class="px-2 py-1 rounded text-sm {{ $b->status === 'dipinjam' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">{{ $b->status }}</span></td>
                        <td class="px-4 py-3">
                            @if($b->status === 'dipinjam')
                                <form action="{{ route('borrowings.return', $b) }}" method="POST" class="inline">@csrf<button type="submit" class="text-green-600 hover:text-green-800 mr-2">Kembalikan</button></form>
                            @endif
                            <form action="{{ route('borrowings.destroy', $b) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:text-red-800">Hapus</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-8 text-center text-gray-500">Belum ada data peminjaman.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $borrowings->links() }}</div>
</div>
@endsection
