@extends('layout/main')

@section('container')
    <p>Ini adalah halaman {{ $judul }} sederhana yang dibuat menggunakan HTML</p>

    <form action="/user/change-pic/{{ Auth::user()->id }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        
        <label for="foto">
            @if (Auth::user()->profile_picture != '')
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="tidak ada foto" width="200" height="200">
            @else
                <p>anda belum punya foto</p>
            @endif
        </label>

        <input type="file" id="foto" name="foto" accept="image/*">

        <br>

        <button type="submit" name="kirim">kirim</button>
    </form>

    <a href="../">kembali</a>

    <script>
        document.querySelector('input[type=file]').addEventListener('change', function(){
            this.form.submit();
        });
    </script>
@endsection