<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peran</title>
</head>
<body>
    <center>
        <h1>Selamat Datang</h1>
        <p>Ini adalah halaman peran sederhana yang dibuat menggunakan HTML</p>
        
        @foreach ($peran as $prn)
            <p>{{ $prn }}</p>
        @endforeach
    </center>
</body>
</html>