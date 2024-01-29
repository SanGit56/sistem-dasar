@extends('layout/main')

@section('container')
  <p>Ini adalah halaman {{ $judul }} sederhana yang dibuat menggunakan HTML</p>

  <table border=1>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>description</th>
        <th>role_menu/th>
    </tr>

      @foreach ($menu as $mn)
        <tr>
            <td>{{ $mn->id }}</td>
            <td>{{ $mn->name }}</td>
            <td>{{ $mn->description }}</td>
            <td>
              @foreach ($mn->roles as $mn_prn)
                  - {{ $mn_prn->id }} {{ $mn_prn->name }} <br>
              @endforeach
            </td>
        </tr>
      @endforeach
  </table>
@endsection