<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD App</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
    .status-select {
        padding: 5px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .search-button{
        background-color: blue;
        color: white;
    }
    .search-button:hover{
        background-color: rgba(255, 3, 3, 0.644);
    }
</style>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/students">CRUD App</a>
        </nav>

        <div class="mt-4">
            @yield('content')
        </div>
    </div>

    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
</body>

</html>
