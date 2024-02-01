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
        <th>peran</th>
    </tr>

    <tr>
        <td>{{ $pengguna->id }}</td>
        <td>{{ $pengguna->username }}</td>
        <td>{{ $pengguna->name }}</td>
        <td>{{ $pengguna->email }}</td>
        <td>{{ $pengguna->password }}</td>
        <td>{{ $pengguna->status }}</td>
        <td>
          @foreach ($pengguna->roles as $pgn_prn)
              - {{ $pgn_prn->id }} {{ $pgn_prn->name }} <br>
          @endforeach
        </td>
    </tr>
  </table>

  <h2>All Roles</h2>
  <ul>
      @foreach ($peran as $prn)
          <li>
              {{ $prn->name }} 
              @if ($pengguna->roles->contains($prn))
                <input type="checkbox" id="punya-peran" name="punya-peran" value="1" checked>
              @else
                <input type="checkbox" id="punya-peran" name="punya-peran" value="0">
              @endif
          </li>
      @endforeach
  </ul>

  <a href="../user">kembali</a>
@endsection