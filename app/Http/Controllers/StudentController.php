<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;


class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Student::query();

        if (!empty($search)) {
            $query->where('sname', 'LIKE', '%' . $search . '%')
                ->orWhere('semail', 'LIKE', '%' . $search . '%');
        }

        $students = $query->orderBy('id', 'desc')->paginate(5);
        return view('students.index', compact('students', 'search'));
    }

    public function create()
    {
        try {
            return view('students.create');
        } catch (\Exception $e) {
            return Redirect('/students')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'sname' => 'required',
                'semail' => 'required|email|unique:students',
                'smobile' => 'nullable|numeric|digits:10|unique:students',
                'sgender' => 'required|in:f,m,o',
                'status' => 'boolean',
                'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'profile_picture.image' => 'The profile picture must be an image.',
                'profile_picture.mimes' => 'The profile picture must be a JPEG, PNG, JPG, or GIF file.',
                'profile_picture.max' => 'The profile picture may not be greater than 2MB.',
            ]);

            DB::beginTransaction();
            // Handle profile picture upload
            if ($request->hasFile('profile_picture')) {


                $fileName = time() . '.' . $request->profile_picture->extension();

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


            $student = Student::create($data);
            if($student) {
                DB::commit();
            }
            else{
                DB::rollBack();
            }
            return redirect('/students')->with('success', 'Student created successfully.');
        } catch (\Exception $e) {
            return Redirect('/students')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit(Student $student)
    {
        try {
            return view('students.edit', compact('student'));
        } catch (\Exception $e) {
            return Redirect('/students')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Student $student)
    {
        try {
            $request->validate([
                'sname' => 'required',
                'semail' => 'required|email|unique:students,semail,' . $student->id,
                'smobile' => 'required|numeric|unique:students,smobile,digits:10' . $student->id,
                'sgender' => 'required|in:f,m,o',
                'status' => 'boolean',
                'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'profile_picture.image' => 'The profile picture must be an image.',
                'profile_picture.mimes' => 'The profile picture must be a JPEG, PNG, JPG, or GIF file.',
                'profile_picture.max' => 'The profile picture may not be greater than 2MB.',
            ]);

            // Handle profile picture update
            if ($request->hasFile('profile_picture')) {
                $fileName = time() . '.' . $request->profile_picture->extension();

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
        } catch (\Exception $e) {
            return Redirect('/students')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy(Student $student)
    {
        try {


            $student->delete();

            return redirect('/students')->with('success', 'Student deleted successfully.');
        } catch (\Exception $e) {
            return Redirect('/students')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function updateStatus(Request $request, $id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->status = $request->input('status');
            $student->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return Redirect('/students')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function view(Student $student)
    {
        try {
            return view('students.view', compact('student'));
        } catch (\Exception $e) {
            return Redirect('/students')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
