@extends('layout/main')

@section('container')
  <a href="/role-add">tambah</a>
  <a href="/role-deleted">tempat sampah</a>
  
  <p>Ini adalah halaman {{ $judul }} sederhana yang dibuat menggunakan HTML</p>

  <form action="" method="GET">
    <input type="text" id="cari" name="cari" placeholder="ketik nama">
    <button>cari</button>
  </form>

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
              <a href="">detail</a>
              <a href="/role-edit/{{ $prn->id }}">ubah</a>
              
              <form action="/role/delete/{{ $prn->id }}" method="POST">
                @method('delete')
                @csrf
  
                <button onclick="return confirm('yakin?')">hapus</button>
              </form>
            </td>
        </tr>
      @endforeach
  </table>

  {{ $peran->withQueryString()->links() }}
@endsection