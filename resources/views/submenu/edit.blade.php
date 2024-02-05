@extends('layout/main')

@section('container')
    <p>Ini adalah halaman {{ $judul }} sederhana yang dibuat menggunakan HTML</p>

    <form action="/submenu/update/{{ $submenu->id }}" method="post" novalidate>
        @method('PUT')
        @csrf
        
        <label for="menu">menu:</label>
        <select id="menu" name="menu" required>
            @foreach ($menu as $mn)
                <option value="{{ $mn->id }}"  {{ ($mn->id == $submenu->menu_id) ? 'selected' : ''; }}>{{ $mn->name }}</option>
            @endforeach
        </select>
        <span class="error"></span>

        <br>

        <label for="nama">nama:</label>
        <input type="text" id="nama" name="nama" value="{{ $submenu->name }}" required maxlength="32">
        <span class="error"></span>

        <br>

        <label for="posisi">posisi:</label>
        <input type="text" id="posisi" name="posisi" value="{{ $submenu->position }}" required maxlength="4">
        <span class="error"></span>

        <br>

        <label for="aktif">aktif:</label>
        <input type="checkbox" id="aktif" name="aktif" {{ ($submenu->is_active == 1) ? 'checked' : ''; }}>

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
        } else {
            showError();
        }
        });
        
        posisi.addEventListener("input", (event) => {
        if (posisi.validity.valid) {  
            posisiError.textContent = "";
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