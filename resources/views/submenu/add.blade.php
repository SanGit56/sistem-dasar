@extends('layout/main')

@section('container')
    <p>Ini adalah halaman {{ $judul }} sederhana yang dibuat menggunakan HTML</p>

    <form action="/submenu/insert" method="post" enctype="multipart/form-data" novalidate>
        @csrf
        
        <label for="menu">menu:</label>
        <select id="menu" name="menu" required>
            <option value="" disabled selected>--- pilih menu ---</option>

            @foreach ($menu as $mn)
                <option value="{{ $mn->id }}">{{ $mn->name }}</option>
            @endforeach
        </select>
        <span class="error"></span>

        <br>

        <label for="nama">nama:</label>
        <input type="text" id="nama" name="nama" required maxlength="32">
        <span class="error"></span>

        <br>

        <label for="posisi">posisi:</label>
        <input type="text" id="posisi" name="posisi" required maxlength="4">
        <span class="error"></span>

        <br>

        <label for="aktif">aktif:</label>
        <input type="checkbox" id="aktif" name="aktif">

        <br>

        <input type="submit" value="kirim">
    </form>

    <a href="../submenu">kembali</a>

    <script>
        const form = document.querySelector("form");
        const menu = document.getElementById("menu");
        const menuError = document.querySelector("#menu + span.error");
        const nama = document.getElementById("nama");
        const namaError = document.querySelector("#nama + span.error");
        const posisi = document.getElementById("posisi");
        const posisiError = document.querySelector("#posisi + span.error");

        nama.addEventListener("input", (event) => {
        if (nama.validity.valid) {  
            namaError.textContent = ""; 
            namaError.className = "error"; 
        } else {
            showError();
        }
        });
        
        posisi.addEventListener("input", (event) => {
        if (posisi.validity.valid) {  
            posisiError.textContent = ""; 
            posisiError.className = "error"; 
        } else {
            showError();
        }
        });

        form.addEventListener("submit", (event) => {
        if (menu.value == "" || !nama.validity.valid || !deskripsi.validity.valid) {    
            showError();
            event.preventDefault();
        }
        });

        function showError() {
            if (menu.value == "") {
                menuError.textContent = "menu harus diisi";
            }

            if (nama.validity.valueMissing) {
                namaError.textContent = "nama harus diisi";
            } else if (nama.validity.tooLong) {
                namaError.textContent = `maksimal ${nama.maxLength} karakter; anda memasukkan ${nama.value.length}.`;
            }

            if (posisi.validity.valueMissing) {
                posisiError.textContent = "posisi harus diisi";
            } else if (posisi.validity.tooLong) {
                posisiError.textContent = `maksimal ${posisi.maxLength} karakter; anda memasukkan ${posisi.value.length}.`;
            }
        }
    </script>
@endsection