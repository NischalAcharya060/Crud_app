@extends('layouts.app')

@section('content')
    <h1>Student Details</h1>

    <table class="table">
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $student->id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $student->sname }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $student->semail }}</td>
            </tr>
            <tr>
                <th>Mobile</th>
                <td>{{ $student->smobile }}</td>
            </tr>
            <tr>
                <th>Gender</th>
                <td>{{ $student->sgender }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $student->status ? 'Active' : 'Inactive' }}</td>
            </tr>
        </tbody>
    </table>
@endsection
