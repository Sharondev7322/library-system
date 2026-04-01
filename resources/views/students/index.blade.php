@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Anggota/Siswa</h1>
        <a href="{{ route('students.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Anggota</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left">NIS</th>
                    <th class="px-4 py-3 text-left">Nama</th>
                    <th class="px-4 py-3 text-left">Kelas</th>
                    <th class="px-4 py-3 text-left">Peminjaman</th>
                    <th class="px-4 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $student->nis }}</td>
                        <td class="px-4 py-3">{{ $student->nama }}</td>
                        <td class="px-4 py-3">{{ $student->kelas }}</td>
                        <td class="px-4 py-3">{{ $student->borrowings_count }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ route('students.show', $student) }}" class="text-blue-600 hover:text-blue-800 mr-2">Detail</a>
                            <a href="{{ route('students.edit', $student) }}" class="text-yellow-600 hover:text-yellow-800 mr-2">Edit</a>
                            <form action="{{ route('students.destroy', $student) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">Belum ada data anggota.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $students->links() }}</div>
</div>
@endsection
