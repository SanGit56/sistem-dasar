<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengguna</title>
</head>
<body>
    <center>
        <h1>Selamat Datang</h1>
        <p>Ini adalah halaman pengguna sederhana yang dibuat menggunakan HTML</p>
        
        @foreach ($pengguna as $pgn)
            <p>{{ $pgn }}</p>
        @endforeach
    </center>
</body>
</html>