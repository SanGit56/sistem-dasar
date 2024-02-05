@extends('layout/main')

@section('container')
    <p>Ini adalah halaman {{ $judul }} sederhana yang dibuat menggunakan HTML</p>

    <form action="/menu/insert" method="post" enctype="multipart/form-data" novalidate>
        @csrf
        
        <label for="nama">nama:</label>
        <input type="text" id="nama" name="name" required maxlength="32">
        <span class="error"></span>

        <br>

        <label for="deskripsi">deskripsi:</label>
        <input type="text" id="deskripsi" name="description" maxlength="64">
        <span class="error"></span>

        <br>

        <input type="submit" value="kirim">
    </form>

    <a href="../menu">kembali</a>

    <script>
        const form = document.querySelector("form");
        const nama = document.getElementById("nama");
        const namaError = document.querySelector("#nama + span.error");
        const deskripsi = document.getElementById("deskripsi");
        const deskripsiError = document.querySelector("#deskripsi + span.error");

        nama.addEventListener("input", (event) => {
        if (nama.validity.valid) {  
            namaError.textContent = ""; 
            namaError.className = "error"; 
        } else {
            showError();
        }
        });

        deskripsi.addEventListener("input", (event) => {
        if (deskripsi.validity.valid) {  
            deskripsiError.textContent = ""; 
            deskripsiError.className = "error"; 
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
            if (nama.validity.valueMissing) {
                namaError.textContent = "nama harus diisi";
            } else if (nama.validity.tooLong) {
                namaError.textContent = `maksimal ${nama.maxLength} karakter; anda memasukkan ${nama.value.length}.`;
            }
            
            if (deskripsi.validity.tooLong) {
                deskripsiError.textContent = `maksimal ${deskripsi.maxLength} karakter; anda memasukkan ${deskripsi.value.length}.`;
            }
        }
    </script>
@endsection