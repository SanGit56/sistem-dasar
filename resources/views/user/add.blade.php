@extends('layout/main')

@section('container')
    <p>Ini adalah halaman {{ $judul }} sederhana yang dibuat menggunakan HTML</p>

    @if ($errors->any())
        @foreach ($errors->all() as $err)
            {{ $err }} <br>
        @endforeach

        <br>
    @endif

    <form action="/user/insert" method="post" enctype="multipart/form-data" novalidate>
        @csrf
        
        <label for="nama-pengguna">nama pengguna:</label>
        <input type="text" id="nama-pengguna" name="username" required maxlength="16">
        <span class="error"></span>

        <br>

        <label for="nama">nama:</label>
        <input type="text" id="nama" name="name" required maxlength="64">
        <span class="error"></span>

        <br>

        <label for="surel">surel:</label>
        <input type="email" id="surel" name="email" required maxlength="64">
        <span class="error"></span>

        <br>

        <label for="kata-sandi">kata sandi:</label>
        <input type="password" id="kata-sandi" name="password" required minlength="8">
        <span class="error"></span>

        <br>

        <label for="sandi-lagi">ketik ulang kata sandi:</label>
        <input type="password" id="sandi-lagi" name="sandilagi" required minlength="8" onchange="cekSandi()">
        <span class="error"></span>

        <br>

        <label for="status">Status:</label>
        <input type="checkbox" id="status" name="status">

        <br>

        <label for="foto">unggah foto:</label>
        <input type="file" id="foto" name="foto" accept="image/*">

        <br>

        <input type="submit" value="kirim">
    </form>

    <a href="../user">kembali</a>

    <script>
        const form = document.querySelector("form");
        const napeng = document.getElementById("nama-pengguna");
        const napengError = document.querySelector("#nama-pengguna + span.error");
        const nama = document.getElementById("nama");
        const namaError = document.querySelector("#nama + span.error");
        const surel = document.getElementById("surel");
        const surelError = document.querySelector("#surel + span.error");
        const kasan = document.getElementById("kata-sandi");
        const kasanError = document.querySelector("#kata-sandi + span.error");
        const sandilagi = document.getElementById("sandi-lagi");
        const sandilagiError = document.querySelector("#sandi-lagi + span.error");

        napeng.addEventListener("input", (event) => {
        if (napeng.validity.valid) {  
            napengError.textContent = "";
        } else {
            showError();
        }
        });

        nama.addEventListener("input", (event) => {
        if (nama.validity.valid) {  
            namaError.textContent = "";
        } else {
            showError();
        }
        });

        surel.addEventListener("input", (event) => {
        if (surel.validity.valid) {  
            surelError.textContent = "";
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

        sandilagi.addEventListener("input", (event) => {
        if (sandilagi.validity.valid) {  
            sandilagiError.textContent = "";
        } else {
            showError();
        }
        });

        form.addEventListener("submit", (event) => {
        if (!napeng.validity.valid || !nama.validity.valid || !surel.validity.valid || !kasan.validity.valid || !sandilagi.validity.valid) {    
            showError();
            event.preventDefault();
        }
        });

        function showError() {
        if (napeng.validity.valueMissing) {
            napengError.textContent = "nama pengguna harus diisi";
        } else if (napeng.validity.tooLong) {
            napengError.textContent = `maksimal ${napeng.maxLength} karakter; anda memasukkan ${napeng.value.length}.`;
        }

        if (nama.validity.valueMissing) {
            namaError.textContent = "nama harus diisi";
        } else if (nama.validity.tooLong) {
            namaError.textContent = `maksimal ${nama.maxLength} karakter; anda memasukkan ${nama.value.length}.`;
        }

        if (surel.validity.valueMissing) {
            surelError.textContent = "surel harus diisi";
        } else if (surel.validity.tooLong) {
            surelError.textContent = `maksimal ${surel.maxLength} karakter; anda memasukkan ${surel.value.length}.`;
        } else if (surel.validity.typeMismatch) {
            surelError.textContent = "surel tidak valid";
        }

        if (kasan.validity.valueMissing) {
            kasanError.textContent = "kata sandi harus diisi";
        } else if (kasan.validity.tooShort) {
            kasanError.textContent = `minimal ${kasan.minLength} karakter; anda memasukkan ${kasan.value.length}.`;
        }

        if (sandilagi.validity.valueMissing) {
            sandilagiError.textContent = "sandi lagi harus diisi";
        } else if (sandilagi.validity.tooShort) {
            sandilagiError.textContent = `minimal ${sandilagi.minLength} karakter; anda memasukkan ${sandilagi.value.length}.`;
        } else if (sandilagi.validity.patternMismatch) {
            sandilagiError.textContent = "sandi tidak sama";
        }
        }

        function cekSandi() {
        sandilagi.pattern = '^' + kasan.value.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&') + '$';
        }
    </script>
@endsection