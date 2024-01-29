<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $judul }}</title>
</head>
<body>
    @include('layout/nav')

    <div>
        <h1>{{ $judul }}</h1>

        @yield('container')
    </div>
</body>
</html>