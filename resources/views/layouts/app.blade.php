<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Perpustakaan') - Sistem Perpustakaan Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar { transition: transform 0.3s ease; }
        .sidebar.collapsed { transform: translateX(-100%); }
        @media (min-width: 768px) {
            .sidebar { transform: translateX(0) !important; }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="sidebar fixed md:static inset-y-0 left-0 z-50 w-64 bg-indigo-800 text-white flex flex-col">
        <!-- Logo -->
        <div class="flex items-center gap-3 px-6 py-5 border-b border-indigo-700">
            <i class="fas fa-book-open text-2xl"></i>
            <span class="font-bold text-xl">Perpustakaan</span>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-700 transition {{ request()->routeIs('dashboard') ? 'bg-indigo-700' : '' }}">
                <i class="fas fa-tachometer-alt w-5 text-center"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('books.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-700 transition {{ request()->routeIs('books.*') ? 'bg-indigo-700' : '' }}">
                <i class="fas fa-book w-5 text-center"></i>
                <span>Buku</span>
            </a>
            <a href="{{ route('students.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-700 transition {{ request()->routeIs('students.*') ? 'bg-indigo-700' : '' }}">
                <i class="fas fa-users w-5 text-center"></i>
                <span>Anggota</span>
            </a>
            <a href="{{ route('borrowings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-700 transition {{ request()->routeIs('borrowings.*') ? 'bg-indigo-700' : '' }}">
                <i class="fas fa-hand-holding w-5 text-center"></i>
                <span>Peminjaman</span>
            </a>
            <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-700 transition {{ request()->routeIs('categories.*') ? 'bg-indigo-700' : '' }}">
                <i class="fas fa-tags w-5 text-center"></i>
                <span>Kategori</span>
            </a>
        </nav>

        <!-- Sidebar Footer -->
        <div class="px-6 py-4 border-t border-indigo-700 text-sm text-indigo-300">
            <p>Sistem Perpustakaan</p>
            <p>v1.0.0</p>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-h-screen">

        <!-- Top Bar -->
        <header class="bg-white shadow-sm border-b px-6 py-3 flex items-center justify-between">
            <!-- Mobile Menu Toggle -->
            <button onclick="toggleSidebar()" class="md:hidden text-gray-600 hover:text-gray-800">
                <i class="fas fa-bars text-xl"></i>
            </button>

            <!-- Search -->
            <div class="flex-1 max-w-md mx-4">
                <div class="relative">
                    <input type="text" placeholder="Cari buku, anggota..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>

            <!-- Right Actions -->
            <div class="flex items-center gap-4">
                <!-- Notifications -->
                <button class="relative text-gray-600 hover:text-gray-800">
                    <i class="fas fa-bell text-xl"></i>
                    <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                </button>

                <!-- Settings -->
                <button class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-cog text-xl"></i>
                </button>

                <!-- Account -->
                <div class="flex items-center gap-2 cursor-pointer hover:bg-gray-100 px-3 py-2 rounded-lg">
                    <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white font-semibold">A</div>
                    <span class="hidden md:block text-sm font-medium text-gray-700">Admin</span>
                    <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="flex-1 p-6">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex items-center justify-between">
                    <span><i class="fas fa-check-circle mr-2"></i>{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900"><i class="fas fa-times"></i></button>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 flex items-center justify-between">
                    <span><i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}</span>
                    <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900"><i class="fas fa-times"></i></button>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t px-6 py-4 text-center text-sm text-gray-500">
            © 2026 Sistem Perpustakaan Sekolah. All rights reserved.
        </footer>
    </div>

    <!-- Overlay for mobile -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden" onclick="toggleSidebar()"></div>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('collapsed');
            overlay.classList.toggle('hidden');
        }
    </script>
</body>
</html>
