@extends('layouts.app')

@section('title', 'Pengaturan')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Pengaturan Perpustakaan</h1>
        <p class="text-gray-600">Kelola pengaturan umum perpustakaan</p>
    </div>

    <div class="bg-white rounded-lg shadow">
        <form action="{{ route('settings.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="p-6 space-y-6">
                <!-- Nama Perpustakaan -->
                <div>
                    <label for="library_name" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-landmark mr-2 text-gray-500"></i>Nama Perpustakaan
                    </label>
                    <input type="text" id="library_name" name="library_name"
                        value="{{ $settings['library_name'] ?? $defaults['library_name'] }}"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('library_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat -->
                <div>
                    <label for="library_address" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-map-marker-alt mr-2 text-gray-500"></i>Alamat
                    </label>
                    <textarea id="library_address" name="library_address" rows="2"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ $settings['library_address'] ?? $defaults['library_address'] }}</textarea>
                    @error('library_address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Lama Peminjaman -->
                <div>
                    <label for="borrowing_days" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-calendar-alt mr-2 text-gray-500"></i>Lama Peminjaman (Hari)
                    </label>
                    <input type="number" id="borrowing_days" name="borrowing_days"
                        value="{{ $settings['borrowing_days'] ?? $defaults['borrowing_days'] }}"
                        min="1" max="90"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <p class="mt-1 text-sm text-gray-500">Durasi maksimal peminjaman buku dalam hari.</p>
                    @error('borrowing_days')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Denda Per Hari -->
                <div>
                    <label for="fine_per_day" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-money-bill-wave mr-2 text-gray-500"></i>Denda Per Hari (Rp)
                    </label>
                    <input type="number" id="fine_per_day" name="fine_per_day"
                        value="{{ $settings['fine_per_day'] ?? $defaults['fine_per_day'] }}"
                        min="0" max="100000"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <p class="mt-1 text-sm text-gray-500">Denda yang dikenakan per hari keterlambatan.</p>
                    @error('fine_per_day')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t flex justify-end gap-3">
                <a href="{{ route('dashboard') }}" class="px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-100 transition">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    <i class="fas fa-save mr-2"></i>Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
