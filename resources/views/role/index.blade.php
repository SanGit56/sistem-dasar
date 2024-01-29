@extends('layout/main')

@section('container')
  <p>Ini adalah halaman {{ $judul }} sederhana yang dibuat menggunakan HTML</p>

  <table border=1>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>description</th>
    </tr>

      @foreach ($peran as $prn)
        <tr>
            <td>{{ $prn->id }}</td>
            <td>{{ $prn->name }}</td>
            <td>{{ $prn->description }}</td>
        </tr>
      @endforeach
  </table>
@endsection