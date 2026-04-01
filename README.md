# 📚 Sistem Perpustakaan Sekolah

Sistem manajemen perpustakaan sekolah berbasis Laravel 12 dengan Tailwind CSS.

## ✨ Fitur

- **Dashboard** — Statistik buku, anggota, dan peminjaman
- **CRUD Buku** — Tambah, edit, hapus buku dengan cover image
- **CRUD Anggota** — Manajemen data siswa/anggota
- **Peminjaman** — Catat dan kelola peminjaman buku
- **Kategori** — Kelompokkan buku berdasarkan kategori
- **Responsive** — Tampilan mobile-friendly

## 🛠️ Tech Stack

- **Backend:** Laravel 12
- **Frontend:** Blade + Tailwind CSS (CDN)
- **Database:** SQLite
- **Icons:** Font Awesome 6

## 🚀 Instalasi

```bash
# Clone repository
git clone https://github.com/sharondev7322/library-system.git
cd library-system

# Install dependency
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
touch database/database.sqlite
php artisan migrate
php artisan db:seed

# Jalankan server
php artisan serve
```

## 📊 Data Dummy

Sistem sudah include data dummy:
- 6 Kategori buku
- 10 Buku populer
- 8 Siswa/anggota
- 7 Data peminjaman

## 📁 Struktur Project

```
library-system/
├── app/
│   ├── Http/Controllers/
│   │   ├── BookController.php
│   │   ├── StudentController.php
│   │   ├── BorrowingController.php
│   │   ├── CategoryController.php
│   │   └── DashboardController.php
│   └── Models/
│       ├── Book.php
│       ├── Student.php
│       ├── Borrowing.php
│       └── Category.php
├── database/
│   ├── migrations/
│   └── seeders/
└── resources/views/
    ├── layouts/
    ├── dashboard.blade.php
    ├── books/
    ├── students/
    ├── borrowings/
    └── categories/
```

## 📝 Lisensi

MIT License
