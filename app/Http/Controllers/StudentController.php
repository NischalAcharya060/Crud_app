<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;



class StudentController extends Controller
{
    public function index()
    {
        $students = Student::orderBy('id','desc')->paginate(10);
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
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'profile_picture.image' => 'The profile picture must be an image.',
            'profile_picture.mimes' => 'The profile picture must be a JPEG, PNG, JPG, or GIF file.',
            'profile_picture.max' => 'The profile picture may not be greater than 2MB.',
        ]);
        // Handle profile picture upload
    if ($request->hasFile('profile_picture')) {
        

        $fileName = time().'.'.$request->profile_picture->extension();
   
        Storage::putFileAs('public/profile_pictures', $request->profile_picture, $fileName);
        storage_path() . '/app/public/profile_pictures' . '/' . $fileName;
        
        $request->merge(['profile_picture' => $fileName]);
        $data['sname'] = $request->sname;
        $data['semail'] = $request->semail;
        $data['smobile'] = $request->smobile;
        $data['sgender'] = $request->sgender;
        $data['status'] = $request->status;
        $data['profile_picture'] = $fileName;
    }
  

    Student::create($data);

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
            'smobile' => 'required|numeric|min:10|unique:students,smobile,' . $student->id,
            'sgender' => 'required|in:f,m,o',
            'status' => 'boolean',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'profile_picture.image' => 'The profile picture must be an image.',
            'profile_picture.mimes' => 'The profile picture must be a JPEG, PNG, JPG, or GIF file.',
            'profile_picture.max' => 'The profile picture may not be greater than 2MB.',
        ]);

        // Handle profile picture update
        if ($request->hasFile('profile_picture')) {
            $fileName = time().'.'.$request->profile_picture->extension();
        
            Storage::putFileAs('public/profile_pictures', $request->profile_picture, $fileName);
            $request->merge(['profile_picture' => $fileName]);
            $data['profile_picture'] = $fileName;
        }
        
        $data['sname'] = $request->sname;
        $data['semail'] = $request->semail;
        $data['smobile'] = $request->smobile;
        $data['sgender'] = $request->sgender;
        $data['status'] = $request->status;
        
        $student->update($data);
        
        return redirect('/students')->with('success', 'Student updated successfully.');
    }        

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect('/students')->with('success', 'Student deleted successfully.');
    }
}
