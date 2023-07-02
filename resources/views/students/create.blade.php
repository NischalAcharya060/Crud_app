@extends('layouts.app')

@section('content')
    <h1>Create Student</h1>

    <form action="/students" method="POST">
        @csrf

        <div class="form-group">
            <label for="sname">Name</label>
            <input type="text" name="sname" id="sname" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="semail">Email</label>
            <input type="email" name="semail" id="semail" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="smobile">Mobile</label>
            <input type="text" name="smobile" id="smobile" class="form-control">
        </div>

        <div class="form-group">
            <label for="sgender">Gender</label>
            <select name="sgender" id="sgender" class="form-control" required>
                <option value="f">Female</option>
                <option value="m">Male</option>
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

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection