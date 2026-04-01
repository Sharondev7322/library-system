<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Student;
use App\Models\Borrowing;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuku = Book::count();
        $totalAnggota = Student::count();
        $totalKategori = Category::count();
        $peminjamanAktif = Borrowing::where('status', 'dipinjam')->count();
        $totalPeminjaman = Borrowing::count();

        $peminjamanTerbaru = Borrowing::with(['student', 'book'])
            ->latest()
            ->take(5)
            ->get();

        $bukuPopuler = Book::withCount(['borrowings'])
            ->orderBy('borrowings_count', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalBuku',
            'totalAnggota',
            'totalKategori',
            'peminjamanAktif',
            'totalPeminjaman',
            'peminjamanTerbaru',
            'bukuPopuler'
        ));
    }
}
