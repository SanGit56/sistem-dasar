@extends('layout/main')

@section('container')
  <p>Ini adalah halaman {{ $judul }} sederhana yang dibuat menggunakan HTML</p>
  
  <p>Selamat datang {{ (Auth::user()) ? Auth::user()->name : 'tamu' }}</p>
@endsection