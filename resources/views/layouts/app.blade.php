<!DOCTYPE html>
<html lang="en">

<head>
    @livewireStyles
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    {{-- Override Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap-override.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- FONT--}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <style>
        .mt-navbar {
            margin-top: 70px;
        }
    </style>

</head>

<body>
    @include('layouts.navbar')


    <div class="container-fluid mt-navbar">
        <div class="row">
            @include('layouts.sidebar')

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <!-- Page content here -->
                @yield('content')
            </main>
        </div>
    </div>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Letakkan perpustakaan Bootstrap JavaScript dan dependensinya -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Include Livewire Scripts -->
    @livewireScripts
    <script>
        Livewire.on('hideAddUserModal', () => {
            $('#addUserModal').modal('hide');
        });
    </script>
</body>

</html>
