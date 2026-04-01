@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6"><a href="{{ route('students.index') }}" class="text-blue-600 hover:text-blue-800">← Kembali</a></div>
    @if(session('success'))<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>@endif
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-4">{{ $student->nama }}</h1>
        <table class="w-full mb-6">
            <tr class="border-b"><td class="py-2 font-semibold text-gray-600 w-1/3">NIS</td><td class="py-2">{{ $student->nis }}</td></tr>
            <tr class="border-b"><td class="py-2 font-semibold text-gray-600">Kelas</td><td class="py-2">{{ $student->kelas }}</td></tr>
            <tr class="border-b"><td class="py-2 font-semibold text-gray-600">Alamat</td><td class="py-2">{{ $student->alamat ?? '-' }}</td></tr>
        </table>
        <div class="flex gap-2">
            <a href="{{ route('students.edit', $student) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
            <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">@csrf @method('DELETE')<button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Hapus</button></form>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6 mt-6">
        <h2 class="text-xl font-bold mb-4">Riwayat Peminjaman</h2>
        @if($student->borrowings->count() > 0)
            <table class="w-full border-collapse">
                <thead class="bg-gray-100"><tr><th class="border p-2 text-left">Buku</th><th class="border p-2 text-left">Tgl Pinjam</th><th class="border p-2 text-left">Tgl Kembali</th><th class="border p-2 text-left">Status</th></tr></thead>
                <tbody>@foreach($student->borrowings as $b)<tr><td class="border p-2">{{ $b->book->judul }}</td><td class="border p-2">{{ $b->tanggal_pinjam->format('d M Y') }}</td><td class="border p-2">{{ $b->tanggal_kembali ? $b->tanggal_kembali->format('d M Y') : '-' }}</td><td class="border p-2"><span class="px-2 py-1 rounded text-sm {{ $b->status === 'dipinjam' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">{{ $b->status }}</span></td></tr>@endforeach</tbody>
            </table>
        @else<p class="text-gray-500">Belum ada riwayat peminjaman.</p>@endif
    </div>
</div>
@endsection
