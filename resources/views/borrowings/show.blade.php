@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6"><a href="{{ route('borrowings.index') }}" class="text-blue-600 hover:text-blue-800">← Kembali</a></div>
    @if(session('success'))<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>@endif
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-4">Detail Peminjaman</h1>
        <table class="w-full mb-6">
            <tr class="border-b"><td class="py-2 font-semibold text-gray-600 w-1/3">Siswa</td><td class="py-2">{{ $borrowing->student->nama }} ({{ $borrowing->student->nis }})</td></tr>
            <tr class="border-b"><td class="py-2 font-semibold text-gray-600">Buku</td><td class="py-2">{{ $borrowing->book->judul }}</td></tr>
            <tr class="border-b"><td class="py-2 font-semibold text-gray-600">Tanggal Pinjam</td><td class="py-2">{{ $borrowing->tanggal_pinjam->format('d M Y') }}</td></tr>
            <tr class="border-b"><td class="py-2 font-semibold text-gray-600">Tanggal Kembali</td><td class="py-2">{{ $borrowing->tanggal_kembali ? $borrowing->tanggal_kembali->format('d M Y') : 'Belum dikembalikan' }}</td></tr>
            <tr class="border-b"><td class="py-2 font-semibold text-gray-600">Status</td><td class="py-2"><span class="px-2 py-1 rounded {{ $borrowing->status === 'dipinjam' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">{{ $borrowing->status }}</span></td></tr>
        </table>
        <div class="flex gap-2">
            @if($borrowing->status === 'dipinjam')
                <form action="{{ route('borrowings.return', $borrowing) }}" method="POST">@csrf<button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Kembalikan Buku</button></form>
            @endif
            <form action="{{ route('borrowings.destroy', $borrowing) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">@csrf @method('DELETE')<button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Hapus</button></form>
        </div>
    </div>
</div>
@endsection
