<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD App</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>
<style>
    .status-select {
        padding: 5px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .search-form {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 10px;
    }

    .search-input-group {
        max-width: 300px;
        display: flex;
        overflow: hidden;
    }

    .search-input {
        flex: 1;
        border-radius: 10px 0 0 10px;
        border: 1px solid #ccc;
        padding: 8px 12px;
    }

    .search-button {
        border-radius: 0 4px 4px 0;
        border: none;
        background-color: #0062cc;
        color: white;
        padding: 8px 12px;
        cursor: pointer;
    }

    .search-button:hover {
        background-color: #0051a8;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/students">CRUD App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
            </ul>
        </div>
    </nav>
    
    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
</body>

</html>
