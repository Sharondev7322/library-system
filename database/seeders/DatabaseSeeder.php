<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Student;
use App\Models\Borrowing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Kategori
        $categories = [
            ['nama' => 'Fiksi', 'keterangan' => 'Novel, cerpen, dan karya sastra lainnya'],
            ['nama' => 'Non-Fiksi', 'keterangan' => 'Buku pengetahuan umum'],
            ['nama' => 'Sains', 'keterangan' => 'Buku ilmu pengetahuan alam'],
            ['nama' => 'Matematika', 'keterangan' => 'Buku matematika dan statistika'],
            ['nama' => 'Sejarah', 'keterangan' => 'Buku sejarah dan geografi'],
            ['nama' => 'Teknologi', 'keterangan' => 'Buku komputer dan teknologi'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Buku
        $books = [
            ['judul' => 'Laskar Pelangi', 'pengarang' => 'Andrea Hirata', 'isbn' => '978-979-22-1116-2', 'category_id' => 1, 'stok' => 5],
            ['judul' => 'Bumi Manusia', 'pengarang' => 'Pramoedya Ananta Toer', 'isbn' => '978-979-22-0289-7', 'category_id' => 1, 'stok' => 3],
            ['judul' => 'Filosofi Teras', 'pengarang' => 'Henry Manampiring', 'isbn' => '978-602-06-2726-8', 'category_id' => 2, 'stok' => 4],
            ['judul' => 'Sapiens', 'pengarang' => 'Yuval Noah Harari', 'isbn' => '978-0-06-231609-7', 'category_id' => 5, 'stok' => 2],
            ['judul' => 'Sejarah Indonesia Modern', 'pengarang' => 'M.C. Ricklefs', 'isbn' => '978-979-22-1655-9', 'category_id' => 5, 'stok' => 3],
            ['judul' => 'Fisika Dasar', 'pengarang' => 'Halliday & Resnick', 'isbn' => '978-0-470-46908-8', 'category_id' => 3, 'stok' => 6],
            ['judul' => 'Kalkulus', 'pengarang' => 'James Stewart', 'isbn' => '978-0-495-01166-8', 'category_id' => 4, 'stok' => 4],
            ['judul' => 'Clean Code', 'pengarang' => 'Robert C. Martin', 'isbn' => '978-0-13-235088-4', 'category_id' => 6, 'stok' => 3],
            ['judul' => 'Atomic Habits', 'pengarang' => 'James Clear', 'isbn' => '978-0-7352-1129-2', 'category_id' => 2, 'stok' => 5],
            ['judul' => 'Pulang', 'pengarang' => 'Tere Liye', 'isbn' => '978-602-03-3335-5', 'category_id' => 1, 'stok' => 4],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }

        // Siswa
        $students = [
            ['nama' => 'Ahmad Rizki', 'nis' => '2024001', 'kelas' => 'X IPA 1', 'alamat' => 'Jl. Merdeka No. 10'],
            ['nama' => 'Siti Nurhaliza', 'nis' => '2024002', 'kelas' => 'X IPA 2', 'alamat' => 'Jl. Sudirman No. 25'],
            ['nama' => 'Budi Santoso', 'nis' => '2024003', 'kelas' => 'XI IPS 1', 'alamat' => 'Jl. Gatot Subroto No. 15'],
            ['nama' => 'Dewi Kartika', 'nis' => '2024004', 'kelas' => 'XI IPS 2', 'alamat' => 'Jl. Diponegoro No. 30'],
            ['nama' => 'Rizal Ramadhan', 'nis' => '2024005', 'kelas' => 'XII IPA 1', 'alamat' => 'Jl. Ahmad Yani No. 45'],
            ['nama' => 'Putri Amelia', 'nis' => '2024006', 'kelas' => 'XII IPA 2', 'alamat' => 'Jl. Pemuda No. 12'],
            ['nama' => 'Fajar Nugroho', 'nis' => '2024007', 'kelas' => 'X IPA 3', 'alamat' => 'Jl. Veteran No. 8'],
            ['nama' => 'Maya Indah', 'nis' => '2024008', 'kelas' => 'XI IPA 1', 'alamat' => 'Jl. Kartini No. 20'],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }

        // Peminjaman
        $borrowings = [
            ['student_id' => 1, 'book_id' => 1, 'tanggal_pinjam' => '2026-03-25', 'status' => 'dipinjam'],
            ['student_id' => 2, 'book_id' => 3, 'tanggal_pinjam' => '2026-03-26', 'tanggal_kembali' => '2026-03-30', 'status' => 'dikembalikan'],
            ['student_id' => 3, 'book_id' => 6, 'tanggal_pinjam' => '2026-03-27', 'status' => 'dipinjam'],
            ['student_id' => 4, 'book_id' => 9, 'tanggal_pinjam' => '2026-03-28', 'status' => 'dipinjam'],
            ['student_id' => 5, 'book_id' => 7, 'tanggal_pinjam' => '2026-03-20', 'tanggal_kembali' => '2026-03-28', 'status' => 'dikembalikan'],
            ['student_id' => 1, 'book_id' => 2, 'tanggal_pinjam' => '2026-03-29', 'status' => 'dipinjam'],
            ['student_id' => 6, 'book_id' => 4, 'tanggal_pinjam' => '2026-03-30', 'status' => 'dipinjam'],
        ];

        foreach ($borrowings as $borrowing) {
            Borrowing::create($borrowing);
        }
    }
}
