<nav>
    <a href="/">Beranda</a>
    <a href="/user">Pengguna</a>
    <a href="/role">Peran</a>
    <a href="/menu">Menu</a>
    <a href="/submenu">Submenu</a>

    @php
        if (session('sesi_menu')) {
            $menu = session('sesi_menu');

            foreach ($menu as $m) {
                echo '<a href="/' . strtolower($m["name"]) . '">' . $m["id"] . $m["name"] . '</a>';
            }
        }
    @endphp

    @if ((Auth::user()))
        <a href="/user-change-pic">Ganti Foto</a>
        <a href="/user-change-pw">Ganti Sandi</a>
        {{-- <a href="/lupa-sandi">Lupa Sandi</a> --}}
        <a href="/logout">Logout</a>
    @else
        <a href="/login">Log in</a>
        <a href="/signup">Sign up</a>
    @endif
</nav>