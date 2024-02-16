@extends('layout/main')

@section('container')
    <p>Ini adalah halaman {{ $judul }} sederhana yang dibuat menggunakan HTML</p>

    @if ($errors->any())
        @foreach ($errors->all() as $err)
            {{ $err }} <br>
        @endforeach

        <br>
    @endif

    <form action="/user/change-pw/{{ Auth::user()->id }}" method="post" novalidate>
        @method('PUT')
        @csrf

        <label for="sandi-lama">sandi lama:</label>
        <input type="password" id="sandi-lama" name="sandilama" required>
        <span class="error"></span>

        <br>

        <label for="sandi-baru">sandi baru:</label>
        <input type="password" id="sandi-baru" name="sandibaru" required minlength="8">
        <span class="error"></span>

        <br>

        <label for="sandi-lagi">ketik ulang kata sandi baru:</label>
        <input type="password" id="sandi-lagi" name="sandilagi" required minlength="8" onchange="cekSandi()">
        <span class="error"></span>

        <br>

        <input type="submit" value="kirim">
    </form>

    <a href="../">kembali</a>

    <script>
        const form = document.querySelector("form");
        const sandilama = document.getElementById("sandi-lama");
        const sandilamaError = document.querySelector("#sandi-lama + span.error");
        const sandibaru = document.getElementById("sandi-baru");
        const sandibaruError = document.querySelector("#sandi-baru + span.error");
        const sandilagi = document.getElementById("sandi-lagi");
        const sandilagiError = document.querySelector("#sandi-lagi + span.error");

        sandilama.addEventListener("input", (event) => {
        if (sandilama.validity.valid) {  
            sandilamaError.textContent = "";
        } else {
            showError();
        }
        });

        sandibaru.addEventListener("input", (event) => {
        if (sandibaru.validity.valid) {  
            sandibaruError.textContent = "";
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
        if (!sandilama.validity.valid || !sandibaru.validity.valid || !sandilagi.validity.valid) {    
            showError();
            event.preventDefault();
        }
        });

        function showError() {
        if (sandilama.validity.valueMissing) {
            sandilamaError.textContent = "sandi lama harus diisi";
        }

        if (sandibaru.validity.valueMissing) {
            sandibaruError.textContent = "sandi baru harus diisi";
        } else if (sandibaru.validity.tooShort) {
            sandibaruError.textContent = `minimal ${sandibaru.minLength} karakter; anda memasukkan ${sandibaru.value.length}.`;
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
        sandilagi.pattern = '^' + sandibaru.value.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&') + '$';
        }
    </script>
@endsection