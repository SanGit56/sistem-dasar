@extends('layout/main')

@section('container')
  <p>Ini adalah halaman {{ $judul }} sederhana yang dibuat menggunakan HTML</p>

  @if (Session::has('pesan'))
      {{ Session::get('pesan') }}
  @endif

  <table border=1>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>description</th>
        <th>aksi</th>
    </tr>

      @foreach ($menu as $mn)
        <tr>
            <td>{{ $mn->id }}</td>
            <td>{{ $mn->name }}</td>
            <td>{{ $mn->description }}</td>
            <td>
              <a href="/menu/restore/{{ $mn->id }}">pulihkan</a>
            </td>
        </tr>
      @endforeach
  </table>

  <a href="../menu">kembali</a>
@endsection