<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Tokoku')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="/produk">Tokoku</a>
            <a href="/logout" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>
