<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
</head>
<body>
    <div>
        <h1>Masuk</h1>

        @if (Session::has('pesan'))
            {{ Session::get('pesan') }}
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $err)
                {{ $err }} <br>
            @endforeach
        @endif

        <form action="/authenticate" method="post" enctype="multipart/form-data" novalidate>
            @csrf

            <label for="nama-pengguna">nama pengguna:</label>
            <input type="text" id="nama-pengguna" name="username" required>
            <span class="error"></span>

            <br>

            <label for="kata-sandi">kata sandi:</label>
            <input type="password" id="kata-sandi" name="password" required>
            <span class="error"></span>

            <br>

            <input type="submit" value="masuk">
        </form>

        <a href="/">beranda</a>

        <script>
            const form = document.querySelector("form");
            const napeng = document.getElementById("nama-pengguna");
            const napengError = document.querySelector("#nama-pengguna + span.error");
            const kasan = document.getElementById("kata-sandi");
            const kasanError = document.querySelector("#kata-sandi + span.error");

            napeng.addEventListener("input", (event) => {
            if (napeng.validity.valid) {  
                napengError.textContent = "";
            } else {
                showError();
            }
            });

            kasan.addEventListener("input", (event) => {
            if (kasan.validity.valid) {  
                kasanError.textContent = "";
            } else {
                showError();
            }
            });

            form.addEventListener("submit", (event) => {
            if (!nama.validity.valid || !deskripsi.validity.valid) {    
                showError();
                event.preventDefault();
            }
            });

            function showError() {
                if (napeng.validity.valueMissing) {
                    napengError.textContent = "nama pengguna harus diisi";
                }
                
                if (kasan.validity.valueMissing) {
                    kasanError.textContent = "kata sandi harus diisi";
                }
            }
        </script>
    </div>
</body>
</html>