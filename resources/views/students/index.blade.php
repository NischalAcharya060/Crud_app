@extends('layouts.app')

@section('content')
    <h1>Students</h1>

    <a href="/students/create" class="btn btn-primary mb-2">Add New Student</a>

    @if ($students->count() > 0)
    <form action="{{ route('students.index') }}" method="GET" class="search-form">
        <div class="input-group input-group-sm search-input-group">
            <input type="text" name="search" class="form-control search-input" placeholder="Search by name or email"
                value="{{ $search }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary search-button" type="submit"><span class="material-icons">
                    search
                    </span></button>
            </div>
        </div>
    </form>
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (sizeof($students) > 0)
    <table class="table">
        <thead>
            <tr>
                {{-- <th>ID</th> --}}
                <th>S.N</th>
                <th>Profile Picture</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Gender</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            {{-- @foreach ($students as $student) --}}
            @foreach ($students as $key => $student)
                <tr>
                    {{-- <td>{{ $student->id }}</td> --}}
                    <td>{{ ($students->currentPage() - 1) * $students->perPage() + $key + 1 }}</td>
                    <td>
                        @if ($student->profile_picture)
                            <img src="{{ asset('storage/profile_pictures/' . $student->profile_picture) }}"
                                alt="Profile Picture" style="width: 50px; height: 50px;">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>{{ $student->sname }}</td>
                    <td>{{ $student->semail }}</td>
                    <td>{{ $student->smobile }}</td>
                    <td>
                        @if ($student->sgender === 'f')
                            Female
                        @elseif ($student->sgender === 'm')
                            Male
                        @else
                            Other
                        @endif
                    </td>
                    {{-- <td>{{ $student->status ? 'Active' : 'Inactive' }}</td> --}}
                    <td>
                        <select class="status-select" data-student-id="{{ $student->id }}">
                            <option value="1" {{ $student->status ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ !$student->status ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </td>
                    <td>
                        <a href="/students/{{ $student->id }}" class="btn btn-sm btn-info"><span class="material-icons">
                            search
                            </span></a>
                        <a href="/students/{{ $student->id }}/edit" class="btn btn-sm btn-success"><span class="material-icons">
                            edit
                            </span></a>
                        <form action="/students/{{ $student->id }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure you want to delete this student?')"><span class="material-icons">
                                    delete
                                    </span></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>  
    @else
    <div class="alert alert-info">
        No students data found. 
    </div>
    <div class="d-flex justify-content-center">
        <button class="btn btn-sm btn-primary" onclick="back()">Cancel</button>
    </div>
    @endif
    <script>
        function back() {
            window.location.href = "{{ route('students.index') }}";
        }
    </script>
    

    {{ $students->links() }}
@endsection


{{-- to update status --}}
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Listen for status change
            $('.status-select').change(function() {
                var studentId = $(this).data('student-id');
                var status = $(this).val();

                // Send AJAX request to update the database
                $.ajax({
                    url: '/students/' + studentId + '/update-status',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status
                    },
                    success: function(response) {
                        // Handle success response, if needed
                        console.log(response);
                    },
                    error: function(xhr) {
                        // Handle error response, if needed
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
