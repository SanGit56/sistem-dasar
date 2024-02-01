@extends('layout/main')

@section('container')
  <p>Ini adalah halaman {{ $judul }} sederhana yang dibuat menggunakan HTML</p>

  <table border=1>
    <tr>
        <th>id</th>
        <th>user_id</th>
        <th>ip_addr</th>
        <th>device</th>
        <th>browser</th>
        <th>description</th>
        <th>aksi</th>
    </tr>

      @foreach ($catat as $cttn)
        <tr>
            <td>{{ $cttn->id }}</td>
            <td>{{ $cttn->user_id }}</td>
            <td>{{ $cttn->ip_addr }}</td>
            <td>{{ $cttn->device }}</td>
            <td>{{ $cttn->browser }}</td>
            <td>{{ $cttn->description }}</td>
            <td><a href="">detail</a></td>
        </tr>
      @endforeach
  </table>
@endsection