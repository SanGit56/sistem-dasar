@extends('layout/main')

@section('container')
  <p>Ini adalah halaman {{ $judul }} sederhana yang dibuat menggunakan HTML</p>

  @if (Session::has('pesan'))
      {{ Session::get('pesan') }}
  @endif

  <table border=1>
    <tr>
        <th>id</th>
        <th>username</th>
        <th>name</th>
        <th>email</th>
        <th>password</th>
        <th>status</th>
        <th>aksi</th>
    </tr>

      @foreach ($pengguna as $pgn)
        <tr>
            <td>{{ $pgn->id }}</td>
            <td>{{ $pgn->username }}</td>
            <td>{{ $pgn->name }}</td>
            <td>{{ $pgn->email }}</td>
            <td>{{ $pgn->password }}</td>
            <td>{{ $pgn->status }}</td>
            <td>
              <a href="/user/restore/{{ $pgn->id }}">pulihkan</a>
            </td>
        </tr>
      @endforeach
  </table>

  <a href="../user">kembali</a>
@endsection