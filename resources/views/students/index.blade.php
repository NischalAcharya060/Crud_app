@extends('layouts.app')

@section('content')
    <h1>Students</h1>

    <a href="/students/create" class="btn btn-primary mb-2">Add New Student</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Gender</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->sname }}</td>
                    <td>{{ $student->semail }}</td>
                    <td>{{ $student->smobile }}</td>
                    <td>{{ $student->sgender }}</td>
                    <td>{{ $student->status ? 'Active' : 'Inactive' }}</td>
                    <td>
                        
                        <a href="/students/{{ $student->id }}/edit" class="btn btn-sm btn-success">Edit</a>
                        <form action="/students/{{ $student->id }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection