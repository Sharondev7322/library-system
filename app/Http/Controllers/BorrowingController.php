<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Book;
use App\Models\Student;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['student', 'book'])
            ->latest()
            ->paginate(10);
        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $students = Student::all();
        $books = Book::where('stok', '>', 0)->get();
        return view('borrowings.create', compact('students', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'book_id' => 'required|exists:books,id',
            'tanggal_pinjam' => 'required|date',
        ]);

        $book = Book::findOrFail($request->book_id);
        
        if ($book->available_stock <= 0) {
            return back()->with('error', 'Stok buku tidak tersedia.');
        }

        Borrowing::create([
            'student_id' => $request->student_id,
            'book_id' => $request->book_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'status' => 'dipinjam',
        ]);

        return redirect()->route('borrowings.index')->with('success', 'Peminjaman berhasil dicatat.');
    }

    public function show(Borrowing $borrowing)
    {
        $borrowing->load(['student', 'book']);
        return view('borrowings.show', compact('borrowing'));
    }

    public function returnBook(Borrowing $borrowing)
    {
        if ($borrowing->status === 'dikembalikan') {
            return back()->with('error', 'Buku sudah dikembalikan.');
        }

        $borrowing->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now(),
        ]);

        return redirect()->route('borrowings.index')->with('success', 'Buku berhasil dikembalikan.');
    }

    public function destroy(Borrowing $borrowing)
    {
        $borrowing->delete();

        return redirect()->route('borrowings.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
