<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
</head>
<body>
    <center>
        <h1>Selamat Datang</h1>
        <p>Ini adalah halaman menu sederhana yang dibuat menggunakan HTML</p>
        
        @foreach ($menu as $mn)
            <p>{{ $mn }}</p>
        @endforeach
    </center>
</body>
</html>