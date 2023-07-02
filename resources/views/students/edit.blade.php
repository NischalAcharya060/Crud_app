@extends('layouts.app')

@section('content')
    <h1>Edit Student</h1>

    <form action="/students/{{ $student->id }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="sname">Name</label>
            <input type="text" name="sname" id="sname" class="form-control" value="{{ $student->sname }}" required>
        </div>

        <div class="form-group">
            <label for="semail">Email</label>
            <input type="email" name="semail" id="semail" class="form-control" value="{{ $student->semail }}" required>
        </div>

        <div class="form-group">
            <label for="smobile">Mobile</label>
            <input type="text" name="smobile" id="smobile" class="form-control" value="{{ $student->smobile }}">
        </div>

        <div class="form-group">
            <label for="sgender">Gender</label>
            <select name="sgender" id="sgender" class="form-control" required>
                <option value="f" {{ $student->sgender === 'f' ? 'selected' : '' }}>Female</option>
                <option value="m" {{ $student->sgender === 'm' ? 'selected' : '' }}>Male</option>
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

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
