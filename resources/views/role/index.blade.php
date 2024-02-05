@extends('layout/main')

@section('container')
  <a href="/role-add">tambah</a>
  
  <p>Ini adalah halaman {{ $judul }} sederhana yang dibuat menggunakan HTML</p>

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
              <a href="">detail</a>
              <a href="/role-edit/{{ $prn->id }}">ubah</a>
            </td>
        </tr>
      @endforeach
  </table>
@endsection