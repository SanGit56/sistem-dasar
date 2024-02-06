@extends('layout/main')

@section('container')
    <p>Ini adalah halaman {{ $judul }} sederhana yang dibuat menggunakan HTML</p>

    @if ($errors->any())
        @foreach ($errors->all() as $err)
            {{ $err }} <br>
        @endforeach

        <br>
    @endif

    <form action="/role/update/{{ $peran->id }}" method="post" novalidate>
        @method('PUT')
        @csrf
        
        <label for="nama">nama:</label>
        <input type="text" id="nama" name="name" value="{{ $peran->name }}" required maxlength="32">
        <span class="error"></span>

        <br>

        <label for="deskripsi">deskripsi:</label>
        <input type="text" id="deskripsi" name="description" value="{{ $peran->description }}" maxlength="64">
        <span class="error"></span>

        <br>

        <input type="submit" value="kirim">
    </form>

    <a href="../role">kembali</a>

    <script>
        const form = document.querySelector("form");
        const nama = document.getElementById("nama");
        const namaError = document.querySelector("#nama + span.error");
        const deskripsi = document.getElementById("deskripsi");
        const deskripsiError = document.querySelector("#deskripsi + span.error");

        nama.addEventListener("input", (event) => {
        if (nama.validity.valid) {  
            namaError.textContent = "";
        } else {
            showError();
        }
        });

        deskripsi.addEventListener("input", (event) => {
        if (deskripsi.validity.valid) {  
            deskripsiError.textContent = "";
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