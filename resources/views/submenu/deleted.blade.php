@extends('layout/main')

@section('container')
  <p>Ini adalah halaman {{ $judul }} sederhana yang dibuat menggunakan HTML</p>

  @if (Session::has('pesan'))
      {{ Session::get('pesan') }}
  @endif

  <table border=1>
    <tr>
        <th>id</th>
        <th>menu_id</th>
        <th>name</th>
        <th>position</th>
        <th>is_active</th>
        <th>aksi</th>
    </tr>

      @foreach ($submenu as $sm)
        <tr>
            <td>{{ $sm->id }}</td>
            <td>{{ $sm->menu_id }}</td>
            <td>{{ $sm->name }}</td>
            <td>{{ $sm->position }}</td>
            <td>{{ $sm->is_active }}</td>
            <td>
              <a href="/submenu/restore/{{ $sm->id }}">pulihkan</a>
            </td>
        </tr>
      @endforeach
  </table>

  <a href="../submenu">kembali</a>
@endsection