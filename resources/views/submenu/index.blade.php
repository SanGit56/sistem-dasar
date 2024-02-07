@extends('layout/main')

@section('container')
  <a href="/submenu-add">tambah</a>
  <a href="/submenu-deleted">tempat sampah</a>

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
        <th>menu_id</th>
        <th>name</th>
        <th>position</th>
        <th>is_active</th>
        <th>aksi</th>
    </tr>

      @foreach ($submenu as $sm)
        <tr>
            <td>{{ $sm->id }}</td>
            <td>{{ $sm->menu_id }}</td>
            <td>{{ $sm->name }}</td>
            <td>{{ $sm->position }}</td>
            <td>{{ $sm->is_active }}</td>
            <td>
              <a href="">detail</a>
              <a href="/submenu-edit/{{ $sm->id }}">ubah</a>
              
              <form action="/submenu/delete/{{ $sm->id }}" method="POST">
                @method('delete')
                @csrf
  
                <button onclick="return confirm('yakin?')">hapus</button>
              </form>
            </td>
        </tr>
      @endforeach
  </table>

  {{ $submenu->withQueryString()->links() }}
@endsection