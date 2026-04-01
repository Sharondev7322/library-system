<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::withCount('borrowings')->paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:students,nis',
            'kelas' => 'required|string|max:50',
            'alamat' => 'nullable|string',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function show(Student $student)
    {
        $student->load('borrowings.book');
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:students,nis,' . $student->id,
            'kelas' => 'required|string|max:50',
            'alamat' => 'nullable|string',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Anggota berhasil diperbarui.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Anggota berhasil dihapus.');
    }
}
