@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>View Student</h1>

        <div class="card">
            @if ($student->profile_picture)
                <img src="{{ asset('storage/profile_pictures/' . $student->profile_picture) }}" alt="Profile Picture"
                    class="card-img-top">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $student->sname }}</h5>
                <p class="card-text"><strong>Email:</strong> {{ $student->semail }}</p>
                <p class="card-text"><strong>Mobile:</strong> {{ $student->smobile }}</p>
                <p class="card-text"><strong>Gender:</strong> {{ $student->sgender === 'f' ? 'Female' : ($student->sgender === 'm' ? 'Male' : 'Other') }}</p>
                <p class="card-text"><strong>Status:</strong> {{ $student->status ? 'Active' : 'Inactive' }}</p>
                <p class="card-text"><strong>Created Date:</strong> {{ $student->created_at }}</p>
                <p class="card-text"><strong>Updated Date:</strong> {{ $student->updated_at }}</p>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('students.index') }}" class="btn btn-primary">Back to Students</a>
        </div>
    </div>
@endsection
