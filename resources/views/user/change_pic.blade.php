@extends('layout/main')

@section('container')
    <p>Ini adalah halaman {{ $judul }} sederhana yang dibuat menggunakan HTML</p>

    @if (Auth::user()->profile_picture != '')
        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="tidak ada foto" width="200" height="200">
    @else
        <p>anda belum punya foto</p>
    @endif

    <form action="/user/change-pic/{{ Auth::user()->id }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        
        <label for="foto">unggah foto:</label>
        <input type="file" id="foto" name="foto" accept="image/*">

        <br>

        <input type="submit" value="kirim">
    </form>

    <a href="../user">kembali</a>
@endsection