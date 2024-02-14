<nav>
    <a href="/">Beranda</a>
    <a href="/user">Pengguna</a>
    <a href="/role">Peran</a>
    <a href="/menu">Menu</a>
    <a href="/submenu">Submenu</a>
    <a href="/log">Catatan</a>

    @if ((Auth::user()))
        <a href="/user-change-pic">Ganti Foto</a>
        {{-- <a href="/lupa-sandi">Lupa Sandi</a>
        <a href="/ganti-sandi">Ganti Sandi</a> --}}
        <a href="/logout">Logout</a>
    @else
        <a href="/login">Login</a>
    @endif
</nav>