@extends('layouts.app')

@section('content')
    <h1>Create Student</h1>

    <form action="/students" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="sname">Name</label>
            <input type="text" name="sname" id="sname" class="form-control" value="{{ old('sname') }}" required>
            @error('sname')
                <div class="error" style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="semail">Email</label>
            <input type="email" name="semail" id="semail" class="form-control" value="{{ old('semail') }}" required>
            @error('semail')
                <div class="error" style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="smobile">Mobile</label>
            <input type="text" name="smobile" id="smobile" class="form-control" value="{{ old('smobile') }}" required>
            @error('smobile')
                <div class="error" style="color: red;">{{ $message }}</div>
            @enderror
        </div>



        <div class="form-group">
            <label for="sgender">Gender</label>
            <select name="sgender" id="sgender" class="form-control" required>
              <option value="m">Male</option>
              <option value="f">Female</option>
              <option value="o">Other</option>
            </select>
          </div>
          

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <div class="form-group">
            <label for="profile_picture">Profile Picture</label>
            <input type="file" name="profile_picture" id="profile_picture" class="form-control-file">
            @error('profile_picture')
                <div class="error" style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
