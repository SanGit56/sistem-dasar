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

      @foreach ($peran as $prn)
        <tr>
            <td>{{ $prn->id }}</td>
            <td>{{ $prn->name }}</td>
            <td>{{ $prn->description }}</td>
            <td>
              <a href="/role/restore/{{ $prn->id }}">pulihkan</a>
            </td>
        </tr>
      @endforeach
  </table>

  <a href="../role">kembali</a>
@endsection