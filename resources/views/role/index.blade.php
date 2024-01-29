@extends('layout/main')

@section('container')
  <p>Ini adalah halaman {{ $judul }} sederhana yang dibuat menggunakan HTML</p>

  <table border=1>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>description</th>
        <th>user_role</th>
        <th>role_menu</th>
    </tr>

      @foreach ($peran as $prn)
        <tr>
            <td>{{ $prn->id }}</td>
            <td>{{ $prn->name }}</td>
            <td>{{ $prn->description }}</td>
            <td>
              @foreach ($prn->users as $prn_pgn)
                  - {{ $prn_pgn->id }} {{ $prn_pgn->username }} <br>
              @endforeach
            </td>
            <td>
              @foreach ($prn->menus as $prn_mn)
                  - {{ $prn_mn->id }} {{ $prn_mn->name }} <br>
              @endforeach
            </td>
        </tr>
      @endforeach
  </table>
@endsection