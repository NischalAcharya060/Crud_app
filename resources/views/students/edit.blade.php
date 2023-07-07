@extends('layouts.app')

@section('content')
    <h1>Edit Student</h1>

    <form action="/students/{{ $student->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="sname">Name</label>
            <input type="text" name="sname" id="sname" class="form-control" value="{{ $student->sname }}" required>
        </div>

        <div class="form-group">
            <label for="semail">Email</label>
            <input type="email" name="semail" id="semail" class="form-control" value="{{ $student->semail }}"
                required>
        </div>

        <div class="form-group">
            <label for="smobile">Mobile</label>
            <input type="text" name="smobile" id="smobile" class="form-control" value="{{ $student->smobile }}">
        </div>

        <div class="form-group">
            <label for="sgender">Gender</label>
            <select name="sgender" id="sgender" class="form-control" required>
                <option value="m" {{ $student->sgender === 'm' ? 'selected' : '' }}>Male</option>
                <option value="f" {{ $student->sgender === 'f' ? 'selected' : '' }}>Female</option>
                <option value="o" {{ $student->sgender === 'o' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="1" {{ $student->status ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$student->status ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="form-group">
            <label for="profile_picture">Profile Picture</label>
            <input type="file" name="profile_picture" id="profile_picture" class="form-control-file">
            @error('profile_picture')
                <div class="error" style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/students" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
