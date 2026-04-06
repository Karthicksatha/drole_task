<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laravel Assignment</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

</head>

<body>

    @include('partials.navbar')

    <div class="container-fluid">

        <div class="row">

            @include('partials.sidebar')

            <main class="col-md-10 ms-sm-auto px-md-4 py-4">

                @yield('content')

            </main>

        </div>

    </div>

    @include('partials.scripts')

    @stack('scripts')

</body>

</html>
