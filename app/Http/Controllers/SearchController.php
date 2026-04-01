<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Student;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q', '');
        $tab = $request->get('tab', 'books');

        $books = collect();
        $students = collect();
        $borrowings = collect();

        if (strlen($query) >= 2) {
            // Search books
            $books = Book::with('category')
                ->where('judul', 'like', "%{$query}%")
                ->orWhere('pengarang', 'like', "%{$query}%")
                ->orWhere('isbn', 'like', "%{$query}%")
                ->orderBy('judul')
                ->get();

            // Search students
            $students = Student::where('nama', 'like', "%{$query}%")
                ->orWhere('nis', 'like', "%{$query}%")
                ->orderBy('nama')
                ->get();

            // Search borrowings
            $borrowings = Borrowing::with(['student', 'book'])
                ->whereHas('student', function ($q) use ($query) {
                    $q->where('nama', 'like', "%{$query}%");
                })
                ->orWhereHas('book', function ($q) use ($query) {
                    $q->where('judul', 'like', "%{$query}%");
                })
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $totalCount = $books->count() + $students->count() + $borrowings->count();

        return view('search.index', compact('query', 'tab', 'books', 'students', 'borrowings', 'totalCount'));
    }
}
