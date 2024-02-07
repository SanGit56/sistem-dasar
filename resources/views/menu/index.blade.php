@extends('layout/main')

@section('container')
  <a href="/menu-add">tambah</a>
  <a href="/menu-deleted">tempat sampah</a>

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

      @foreach ($menu as $mn)
        <tr>
            <td>{{ $mn->id }}</td>
            <td>{{ $mn->name }}</td>
            <td>{{ $mn->description }}</td>
            <td>
              <a href="">detail</a>
              <a href="/menu-edit/{{ $mn->id }}">ubah</a>
              
              <form action="/menu/delete/{{ $mn->id }}" method="POST">
                @method('delete')
                @csrf
  
                <button onclick="return confirm('yakin?')">hapus</button>
              </form>
            </td>
        </tr>
      @endforeach
  </table>

  {{ $menu->withQueryString()->links() }}
@endsection