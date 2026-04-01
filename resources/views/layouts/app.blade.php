<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Perpustakaan') - Sistem Perpustakaan Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-indigo-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <i class="fas fa-book-open text-2xl mr-2"></i>
                        <span class="font-bold text-xl">Perpustakaan</span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" class="hover:bg-indigo-700 px-3 py-2 rounded-md transition">
                        <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                    </a>
                    <a href="{{ route('books.index') }}" class="hover:bg-indigo-700 px-3 py-2 rounded-md transition">
                        <i class="fas fa-book mr-1"></i> Buku
                    </a>
                    <a href="{{ route('students.index') }}" class="hover:bg-indigo-700 px-3 py-2 rounded-md transition">
                        <i class="fas fa-users mr-1"></i> Anggota
                    </a>
                    <a href="{{ route('borrowings.index') }}" class="hover:bg-indigo-700 px-3 py-2 rounded-md transition">
                        <i class="fas fa-hand-holding mr-1"></i> Peminjaman
                    </a>
                    <a href="{{ route('categories.index') }}" class="hover:bg-indigo-700 px-3 py-2 rounded-md transition">
                        <i class="fas fa-tags mr-1"></i> Kategori
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Button -->
    <div class="md:hidden bg-indigo-700 px-4 py-2">
        <button onclick="toggleMenu()" class="text-white">
            <i class="fas fa-bars"></i> Menu
        </button>
        <div id="mobileMenu" class="hidden mt-2 space-y-2">
            <a href="{{ route('dashboard') }}" class="block text-white hover:bg-indigo-600 px-3 py-2 rounded">Dashboard</a>
            <a href="{{ route('books.index') }}" class="block text-white hover:bg-indigo-600 px-3 py-2 rounded">Buku</a>
            <a href="{{ route('students.index') }}" class="block text-white hover:bg-indigo-600 px-3 py-2 rounded">Anggota</a>
            <a href="{{ route('borrowings.index') }}" class="block text-white hover:bg-indigo-600 px-3 py-2 rounded">Peminjaman</a>
            <a href="{{ route('categories.index') }}" class="block text-white hover:bg-indigo-600 px-3 py-2 rounded">Kategori</a>
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-8">
        @yield('content')
    </main>

    <script>
        function toggleMenu() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        }
    </script>
</body>
</html>
