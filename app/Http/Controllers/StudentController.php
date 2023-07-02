<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sname' => 'required',
            'semail' => 'required|email|unique:students',
            'smobile' => 'nullable|numeric|unique:students',
            'sgender' => 'required|in:f,m,o',
            'status' => 'boolean',
        ]);

        Student::create($request->all());

        return redirect('/students')->with('success', 'Student created successfully.');
    }


    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'sname' => 'required',
            'semail' => 'required|email|unique:students,semail,' . $student->id,
            'smobile' => 'nullable|numeric|unique:students,smobile,' . $student->id,
            'sgender' => 'required|in:f,m,o',
            'status' => 'boolean',
        ]);

        $student->update($request->all());

        return redirect('/students')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect('/students')->with('success', 'Student deleted successfully.');
    }
}
