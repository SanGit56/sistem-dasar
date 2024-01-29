@extends('layout/main')

@section('container')
  <p>Ini adalah halaman {{ $judul }} sederhana yang dibuat menggunakan HTML</p>

  <table border=1>
    <tr>
        <th>id</th>
        <th>username</th>
        <th>name</th>
        <th>email</th>
        <th>password</th>
        <th>status</th>
        <th>user_role</th>

        {{-- <th>profile_picture</th> --}}
        {{-- <th>remember_token</th> --}}
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
              @foreach ($pgn->roles as $pgn_prn)
                  - {{ $pgn_prn->id }} {{ $pgn_prn->name }} <br>
              @endforeach
            </td>

            {{-- <td>{{ $pgn->profile_picture }}</td> --}}
            {{-- <td>{{ $pgn->remember_token }}</td> --}}
        </tr>
      @endforeach
  </table>
@endsection